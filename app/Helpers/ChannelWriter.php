<?php

namespace App\Helpers;

use App\Helpers\Facades\CustomLog;
use Monolog\Logger;

use App\Helpers\ChannelStreamHandler;

class ChannelWriter
{
    /**
     * The Log channels.
     *
     * @var array
     */
    protected $channels = [
        'info' => [
            'path' => 'logs/info.log',
            'level' => Logger::INFO
        ],
        'api' => [
            'path' => 'logs/api.log',
            'level' => Logger::API
        ],
        'error' => [
            'path' => 'logs/errors.log',
            'level' => Logger::ERROR
        ],
        'debug' => [
            'path' => 'logs/debug.log',
            'level' => Logger::DEBUG
        ],
        'warning' => [
            'path' => 'logs/warning.log',
            'level' => Logger::WARNING
        ],
        'batch' => [
            'path' => 'logs/batch.log',
            'level' => Logger::INFO
        ]
    ];

    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [
        'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    public function __construct() {}

    /**
     * Write to log based on the given channel and log level set
     *
     * @param type $channel
     * @param type $message
     * @param array $context
     * @throws InvalidArgumentException
     */
    public function writeLog($channel, $level, $message, array $context = [])
    {
        //check channel exist
        if( !in_array($channel, array_keys($this->channels)) ){
            throw new InvalidArgumentException('Invalid channel used.');
        }

        //lazy load logger
        if( !isset($this->channels[$channel]['_instance']) ){
            //create instance
            $this->channels[$channel]['_instance'] = new Logger($channel);
            //add custom handler
            $this->channels[$channel]['_instance']->pushHandler(
                new ChannelStreamHandler(
                    $channel,
                    storage_path() .'/'. $this->channels[$channel]['path'],
                    $this->channels[$channel]['level']
                )
            );
        }

        //write out record
        $this->channels[$channel]['_instance']->{$level}($message, $context);
    }

    public function write($channel, $message, array $context = []){
        //get method name for the associated level
        $level = array_flip( $this->levels )[$this->channels[$channel]['level']];
        //write to log
        $this->writeLog($channel, $level, $message, $context);
    }

    //alert('event','Message');
    function __call($func, $params){
        if(in_array($func, array_keys($this->levels))){
            return $this->writeLog($params[0], $func, $params[1], isset($params[2]) ? $params[2] : []);
        }
    }

    function logInfo($message, array $context = [])
    {
        CustomLog::info('info', $message, $context);
    }

    function logError($message, array $context = [])
    {
        CustomLog::error('error', $message, $context);
    }

    function logDebug($message, array $context = [])
    {
        CustomLog::debug('debug', $message, $context);
    }

    function logWarning($message, array $context = [])
    {
        CustomLog::warning('warning', $message, $context);
    }

    function logApi($message, array $context = [])
    {
        CustomLog::info('api', $message, $context);
    }

    function logBatch($message, array $context = [])
    {
        CustomLog::info('batch', $message, $context);
    }

}
