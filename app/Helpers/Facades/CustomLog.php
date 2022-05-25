<?php
namespace App\Helpers\Facades;

use App\Helpers\ChannelWriter;
use Illuminate\Support\Facades\Facade;

/**
 * Class ChannelLog
 * @package App\Helpers\Facades
 */
/**
 * @method static void logInfo(string $message, array $context = [])
 * @method static void logError(string $message, array $context = [])
 * @method static void logDebug(string $message, array $context = [])
 * @method static void logWarning(string $message, array $context = [])
 * @method static void logApi(string $message, array $context = [])
 * @method static void logBatch(string $message, array $context = [])
 *
 * @see ChannelWriter
 */
class CustomLog extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return "customlog";
    }
}
