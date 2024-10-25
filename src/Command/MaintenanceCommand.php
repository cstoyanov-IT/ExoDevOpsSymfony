<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Psr\Log\LoggerInterface;

#[AsCommand(
    name: 'app:maintenance',
    description: 'Performs maintenance tasks like cache clearing and generating statistics',
)]
class MaintenanceCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private TagAwareCacheInterface $cache,
        private LoggerInterface $logger
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Clear cache
        $this->cache->invalidateTags(['services_list', 'providers_list']);
        $io->success('Cache cleared successfully');
        $this->logger->info('Cache cleared via maintenance command');

        // Generate statistics
        $providerCount = $this->entityManager
            ->createQuery('SELECT COUNT(p) FROM App\Entity\Provider p')
            ->getSingleScalarResult();
        
        $serviceCount = $this->entityManager
            ->createQuery('SELECT COUNT(s) FROM App\Entity\Service s')
            ->getSingleScalarResult();

        $io->table(
            ['Metric', 'Count'],
            [
                ['Providers', $providerCount],
                ['Services', $serviceCount],
            ]
        );

        $this->logger->info('Statistics generated', [
            'providers_count' => $providerCount,
            'services_count' => $serviceCount,
        ]);

        return Command::SUCCESS;
    }
}