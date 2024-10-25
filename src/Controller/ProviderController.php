<?php

namespace App\Controller;

use App\Entity\Provider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/providers')]
class ProviderController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('', name: 'app_provider_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $providers = $this->entityManager->getRepository(Provider::class)->findAll();
        return $this->json($providers);
    }

    #[Route('', name: 'app_provider_new', methods: ['POST'])]
    public function new(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['phone'])) {
            return $this->json(['error' => 'Missing required fields'], 400);
        }

        $provider = new Provider();
        $provider->setName($data['name']);
        $provider->setEmail($data['email']);
        $provider->setPhone($data['phone']);

        $this->entityManager->persist($provider);
        $this->entityManager->flush();

        return $this->json([
            'status' => 'Provider created successfully',
            'provider' => [
                'id' => $provider->getId(),
                'name' => $provider->getName(),
                'email' => $provider->getEmail(),
                'phone' => $provider->getPhone()
            ]
        ], 201);
    }

    #[Route('/{id}', name: 'app_provider_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id): JsonResponse
    {
        $provider = $this->entityManager->getRepository(Provider::class)->find($id);
        if (!$provider) {
            return $this->json(['message' => 'Provider not found'], 404);
        }

        return $this->json($provider);
    }

    #[Route('/{id}', name: 'app_provider_edit', methods: ['PUT', 'PATCH'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $provider = $this->entityManager->getRepository(Provider::class)->find($id);
        if (!$provider) {
            return $this->json(['message' => 'Provider not found'], 404);
        }

        if (isset($data['name'])) $provider->setName($data['name']);
        if (isset($data['email'])) $provider->setEmail($data['email']);
        if (isset($data['phone'])) $provider->setPhone($data['phone']);

        $this->entityManager->flush();

        return $this->json([
            'status' => 'Provider updated successfully',
            'provider' => [
                'id' => $provider->getId(),
                'name' => $provider->getName(),
                'email' => $provider->getEmail(),
                'phone' => $provider->getPhone()
            ]
        ]);
    }

    #[Route('/{id}', name: 'app_provider_delete', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function delete(int $id): JsonResponse
    {
        $provider = $this->entityManager->getRepository(Provider::class)->find($id);
        if (!$provider) {
            return $this->json(['message' => 'Provider not found'], 404);
        }

        $this->entityManager->remove($provider);
        $this->entityManager->flush();

        return $this->json(['status' => 'Provider deleted successfully']);
    }
}