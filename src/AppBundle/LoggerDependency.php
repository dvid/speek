<?php

namespace AppBundle;

use Psr\Log\LoggerInterface;

class LoggerDependency
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function logInfo($message)
    {
        $this->logger->info($message);
    }
}