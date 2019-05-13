<?php

namespace App\Adapter;

use Swift_SmtpTransport;
use Swift_Spool;

/**
 * Class TransportAdapter
 * @package App\Adapter
 */
class TransportAdapter extends \Swift_SmtpTransport
{
    public function __construct()
    {
        parent::__construct();
    }

}
