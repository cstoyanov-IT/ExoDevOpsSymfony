<?php

namespace App\Controller;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

#[Route('/services')]
class ServiceController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;
    private TagAwareCacheInterface $cache;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        TagAwareCacheInterface $cache
    ) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->cache = $cache;
    }

    #[Route('/', name: 'app_service_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $cacheKey = 'services_list';
        
        $services = $this->cache->get($cacheKey, function (ItemInterface $item) {
            $item->expiresAfter(3600);
            $services = $this->entityManager->getRepository(Service::class)->findAll();
            return $this->serializer->serialize($services, 'json', ['groups' => 'service:read']);
        });

        return new JsonResponse($services, 200, [], true);
    }

    #[Route('/', name: 'app_service_new', methods: ['POST'])]
    public function new(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $service = new Service();
        $service->setName($data['name']);
        $service->setDescription($data['description'] ?? null);
        $service->setPrice($data['price']);
        
        // Get the provider
        $provider = $this->entityManager->getRepository(Provider::class)->find($data['provider_id']);
        if (!$provider) {
            return $this->json(['message' => 'Provider not found'], 404);
        }
        $service->setProvider($provider);

        $this->entityManager->persist($service);
        $this->entityManager->flush();
        
        // Invalidate cache
        $this->cache->invalidateTags(['services_list']);

        return $this->json(
            $service,
            201,
            [],
            ['groups' => 'service:read']
        );
    }

    #[Route('/{id}', name: 'app_service_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $service = $this->entityManager->getRepository(Service::class)->find($id);
        if (!$service) {
            return $this->json(['message' => 'Service not found'], 404);
        }

        return $this->json(
            $service,
            200,
            [],
            ['groups' => 'service:read']
        );
    }

    #[Route('/{id}', name: 'app_service_edit', methods: ['PUT'])]
    public function edit(Request $request, int $id): JsonResponse
    {
        $service = $this->entityManager->getRepository(Service::class)->find($id);
        if (!$service) {
            return $this->json(['message' => 'Service not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        
        $service->setName($data['name']);
        $service->setDescription($data['description'] ?? null);
        $service->setPrice($data['price']);

        if (isset($data['provider_id'])) {
            $provider = $this->entityManager->getRepository(Provider::class)->find($data['provider_id']);
            if (!$provider) {
                return $this->json(['message' => 'Provider not found'], 404);
            }
            $service->setProvider($provider);
        }

        $this->entityManager->flush();
        
        // Invalidate cache
        $this->cache->invalidateTags(['services_list']);

        return $this->json(
            $service,
            200,
            [],
            ['groups' => 'service:read']
        );
    }

    #[Route('/{id}', name: 'app_service_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $service = $this->entityManager->getRepository(Service::class)->find($id);
        if (!$service) {
            return $this->json(['message' => 'Service not found'], 404);
        }

        $this->entityManager->remove($service);
        $this->entityManager->flush();
        
        // Invalidate cache
        $this->cache->invalidateTags(['services_list']);

        return $this->json(['status' => 'Service deleted successfully']);
    }
}