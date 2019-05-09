<?php

namespace App\Adapter;

use Swift_SmtpTransport;
use Swift_Spool;

/**
 * Class TransportAdapter
 * @package App\Adapter
 */
class TransportAdapter extends \Swift_SpoolTransport
{
    public function __construct()
    {
        parent::__construct(new \Swift_MemorySpool());
    }

}
