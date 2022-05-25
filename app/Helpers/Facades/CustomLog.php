<?php
namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ChannelLog
 * @package App\Helpers\Facades
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
