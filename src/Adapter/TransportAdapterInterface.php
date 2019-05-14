<?php

namespace App\Adapter;

use App\Adapter\Transport\TransportInterface;

/**
 * Interface TransportAdapterInterface
 * @package App\Adapter
 */
interface TransportAdapterInterface
{
    /**
     * @param MessageAdapter $messageAdapter
     * @param array|null $failedRecipients
     * @return int
     */
    public function send(MessageAdapter $messageAdapter, &$failedRecipients = null):int;

    /**
     * @return TransportInterface[]
     */
    public function getTransports():array;

    /**
     * @return array
     */
    public function getLog():array;
}