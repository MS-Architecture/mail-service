<?php

namespace App\Adapter\Transport;

use Swift_NullTransport;
use Swift_Plugins_AntiFloodPlugin;
use Swift_Plugins_Logger;
use Swift_Plugins_LoggerPlugin;
use Swift_Plugins_Loggers_ArrayLogger;

/**
 * Class NullAdapter
 * @package App\Adapter\Transport
 */
class NullAdapter extends Swift_NullTransport implements TransportInterface
{
    /**
     * @var Swift_Plugins_Logger
     */
    private $logger;

    /**
     * NullAdapter constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->registerPlugin(
            new Swift_Plugins_AntiFloodPlugin(5, 10)
        );
        $this->logger = new Swift_Plugins_Loggers_ArrayLogger();
        $this->registerPlugin(
            new Swift_Plugins_LoggerPlugin(
                $this->logger
            )
        );
        $this->logger->add('NULL Transport');
    }

    /**
     * @return string
     */
    public function getLog(): string
    {
        return utf8_encode($this->logger->dump());
    }
}