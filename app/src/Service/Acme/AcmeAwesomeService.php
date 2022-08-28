<?php

namespace App\Service\Acme;

use Psr\Log\LoggerInterface;

class AcmeAwesomeService implements AcmeServiceInterface
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function proc()
    {
        $this->logger->info('acme-awesome-service');
    }
}
