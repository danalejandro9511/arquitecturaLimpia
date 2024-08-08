<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\NullHandler;

class DatabaseLogger
{
    public function __invoke(array $config)
    {
        $logger = new Logger('database');

        // Agregamos el handler personalizado
        $logger->pushHandler(new DatabaseLogHandler());

        return $logger;
    }
}