<?php

namespace App\Adapter;

use App\Adapter\Transport\TransportInterface;
use Swift_LoadBalancedTransport;
use Swift_TransportException;

/**
 * Class BalancedTransportAdapter
 * @package App\Adapter
 */
class BalancedTransportAdapter implements TransportAdapterInterface
{
    /**
     * @var Swift_LoadBalancedTransport
     */
    private $transport;

    /**
     * BalancedTransportAdapter constructor.
     * @param TransportInterface[] $transports
     */
    public function __construct($transports = [])
    {
        $this->transport = new Swift_LoadBalancedTransport($transports);
    }

    /**
     * @param MessageAdapter $messageAdapter
     * @param array|null $failedRecipients
     * @return int
     */
    public function send(MessageAdapter $messageAdapter, &$failedRecipients = null): int
    {
        try {
            return $this->transport->send($messageAdapter, $failedRecipients);
        } catch (Swift_TransportException $e) {
            return 0;
        }
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        $transports = $this->getTransports();
        $log = [];
        foreach ($transports as $transport) {
            $log[] = $transport->getLog();
        }
        return $log;
    }

    /**
     * @return TransportInterface[]
     */
    public function getTransports(): array
    {
        return $this->transport->getTransports();
    }
}