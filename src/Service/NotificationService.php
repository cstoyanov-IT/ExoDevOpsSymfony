<?php

namespace App\Service;

use App\Entity\Provider;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;

class NotificationService
{
    public function __construct(
        private MailerInterface $mailer,
        private LoggerInterface $logger,
        private string $adminEmail
    ) {}

    public function notifyProviderCreated(Provider $provider): void
    {
        $email = (new Email())
            ->from('noreply@yourdomain.com')
            ->to($this->adminEmail)
            ->subject('New Provider Created')
            ->html("<p>New provider {$provider->getName()} has been created.</p>");

        try {
            $this->mailer->send($email);
            $this->logger->info('Provider creation notification sent', [
                'provider_id' => $provider->getId(),
                'provider_name' => $provider->getName(),
            ]);
        } catch (\Exception $e) {
            $this->logger->error('Failed to send provider creation notification', [
                'error' => $e->getMessage(),
                'provider_id' => $provider->getId(),
            ]);
        }
    }
}