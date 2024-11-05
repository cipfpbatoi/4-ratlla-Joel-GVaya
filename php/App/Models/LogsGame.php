<?php

namespace Joc4enRatlla\Models;

require_once __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogsGame
{
    private $infoLogger;
    private $errorLogger;

    public function __construct()
    {
        $this->infoLogger = new Logger('info_logger');
        $infoLogFilePath = __DIR__ . '/../../Logs/info.log';
        $this->infoLogger->pushHandler(new StreamHandler($infoLogFilePath, Logger::INFO));

        $this->errorLogger = new Logger('error_logger');
        $errorLogFilePath = __DIR__ . '/../../Logs/error.log';
        $this->errorLogger->pushHandler(new StreamHandler($errorLogFilePath, Logger::ERROR));
    }

    public function logInfo($message)
    {
        $this->infoLogger->info($message);
    }

    public function logError($message)
    {
        $this->errorLogger->error($message);
    }
}
