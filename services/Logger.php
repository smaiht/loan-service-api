<?php 

namespace app\services;

use Yii;

class Logger
{
    private static $logFile;

    public static function log($message, $info = '')
    {
        self::ensureLogFileExists();

        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] [$info] $message\n";

        file_put_contents(self::$logFile, $logMessage, FILE_APPEND);
    }

    private static function ensureLogFileExists()
    {
        if (!self::$logFile) {
            self::$logFile = Yii::getAlias("@app/runtime/logs/api.log");
        }

        if (!file_exists(self::$logFile)) {
            $logDir = dirname(self::$logFile);
            if (!is_dir($logDir)) {
                mkdir($logDir, 0777, true);
            }
            touch(self::$logFile);
        }
    }
}