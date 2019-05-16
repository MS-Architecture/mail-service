<?php

namespace App\Controller;

use App\Entity\Transport;
use App\Entity\TransportEncryption;
use App\Entity\TransportEnvelope;
use App\Entity\TransportGroup;
use App\Entity\TransportProperty;
use App\Entity\TransportProtocol;
use App\Entity\TransportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TransportController
 * @package App\Controller
 */
class TransportController extends AbstractController
{
    use DatabaseTrait;

    /**
     * @Route("/transport", name="transport")
     */
    public function index()
    {
        $transportProtocols = $this->getObjectRepository(TransportProtocol::class)->findAll();
        $transportEnvelopes = $this->getObjectRepository(TransportEnvelope::class)->findAll();
        $transportEncryptions = $this->getObjectRepository(TransportEncryption::class)->findAll();

        $transports = $this->getObjectRepository(Transport::class)->findAll();
        $transportGroups = $this->getObjectRepository(TransportGroup::class)->findAll();
        $transportProperties = $this->getObjectRepository(TransportProperty::class)->findAll();

        return $this->render('transport/index.html.twig', [
            'transportProtocols' => $transportProtocols,
            'transportEnvelopes' => $transportEnvelopes,
            'transportEncryptions' => $transportEncryptions,
            'transports' => $transports,
            'transportGroups' => $transportGroups,
            'transportProperties' => $transportProperties,
            'controller_name' => 'TransportController',
        ]);
    }
}
