<?php

namespace App\Adapter\Transport;

use Swift_Plugins_AntiFloodPlugin;
use Swift_Plugins_Logger;
use Swift_Plugins_LoggerPlugin;
use Swift_Plugins_Loggers_ArrayLogger;
use Swift_SmtpTransport;

/**
 * Class SmtpAdapter
 * @package App\Adapter\Transport
 */
class SmtpAdapter extends Swift_SmtpTransport implements TransportInterface
{
    /**
     * @var Swift_Plugins_Logger
     */
    private $logger;

    /**
     * SmtpAdapter constructor.
     * @param string $host
     * @param int $port
     * @param null|string $encryption
     */
    public function __construct($host = 'localhost', $port = 25, $encryption = null)
    {
        parent::__construct($host, $port, $encryption);

        $this->registerPlugin(
            new Swift_Plugins_AntiFloodPlugin(5, 10)
        );
        $this->logger = new Swift_Plugins_Loggers_ArrayLogger();
        $this->registerPlugin(
            new Swift_Plugins_LoggerPlugin(
                $this->logger
            )
        );
        $this->logger->add('SMTP Transport ' . $host . ':' . $port);
    }

    /**
     * @return string
     */
    public function getLog(): string
    {
        return utf8_encode($this->logger->dump());
    }
}
