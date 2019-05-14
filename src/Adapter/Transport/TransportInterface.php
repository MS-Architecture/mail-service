<?php

namespace App\Adapter\Transport;

/**
 * Interface TransportInterface
 * @package App\Adapter\Transport
 */
interface TransportInterface
{
    /**
     * @return string
     */
    public function getLog(): string;
}