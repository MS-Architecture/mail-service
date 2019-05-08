<?php

namespace App\Adapter;

use Swift_Mailer;
use Swift_Plugins_AntiFloodPlugin;
use Swift_Plugins_LoggerPlugin;
use Swift_Plugins_Loggers_EchoLogger;
use Swift_Plugins_ThrottlerPlugin;

/**
 * Class MailAdapter
 * @package App\Adapter
 */
class MailAdapter extends Swift_Mailer
{
    /**
     * Create a new Mailer using $transport for delivery.
     *
     * @param TransportAdapter $transport
     */
    public function __construct(TransportAdapter $transport)
    {
        parent::__construct($transport);

        $this->registerPlugin(
            new Swift_Plugins_AntiFloodPlugin()
        );
        $this->registerPlugin(
            new Swift_Plugins_ThrottlerPlugin(100)
        );
        $this->registerPlugin(
            new Swift_Plugins_LoggerPlugin(
                new Swift_Plugins_Loggers_EchoLogger()
            )
        );
    }
}
