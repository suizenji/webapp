<?php

namespace App\Service\Acme;

use Psr\Log\LoggerInterface;

/**
 * autowire-comment
 *
 * foo
 */
class AcmeService implements AcmeServiceInterface
{
    public function __construct(
        LoggerInterface $acmeLogger,
    ) {
        $this->logger = $acmeLogger;
    }

    public function proc()
    {
        $this->logger->info('acme-service');
    }
}
