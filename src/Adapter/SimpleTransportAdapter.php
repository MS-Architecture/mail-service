<?php

namespace App\Adapter;

use App\Adapter\Transport\NullAdapter;
use App\Adapter\Transport\SmtpAdapter;
use App\Adapter\Transport\TransportInterface;

/**
 * Class SimpleTransportAdapter
 * @package App\Adapter
 */
class SimpleTransportAdapter implements TransportAdapterInterface
{
    /**
     * @var TransportInterface|NullAdapter|SmtpAdapter
     */
    private $transport;

    /**
     * DefaultTransportAdapter constructor.
     * @param TransportInterface $transport
     */
    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param MessageAdapter $messageAdapter
     * @param array|null $failedRecipients
     * @return int
     */
    public function send(MessageAdapter $messageAdapter, &$failedRecipients = null): int
    {
        return $this->transport->send($messageAdapter, $failedRecipients);
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
        return [$this->transport];
    }
}
