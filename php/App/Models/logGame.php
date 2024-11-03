<?php

namespace Joc4enRatlla;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogsGame
{
    private $infoLogger;
    private $errorLogger;

    /*
    * COnstructor de la classe
    */

    public function __construct()
    {
        $this->infoLogger = new Logger('info_logger');
        $infoLogFilePath = __DIR__ . '/../../Logs/info.log';
        $this->infoLogger->pushHandler(new StreamHandler($infoLogFilePath, Logger::INFO));

        $this->errorLogger = new Logger('error_logger');
        $errorLogFilePath = __DIR__ . '/../../Logs/error.log';
        $this->errorLogger->pushHandler(new StreamHandler($errorLogFilePath, Logger::ERROR));
    }

    /*
    * Metode per crear una entrada d'informacio en l'arxiu info.log
    */

    public function logInfo($message)
    {
        $this->infoLogger->info($message);
    }

    /*
    * Metode per crear una entrada d'error en l'arxiu error.log
    */

    public function logError($message)
    {
        $this->errorLogger->error($message);
    }

}

$logs = new LogsGame();
$logs->logError('Hollaaa');


