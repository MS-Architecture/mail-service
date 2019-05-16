<?php

namespace App\Controller;

use App\Entity\Transport;
use App\Entity\TransportEncryption;
use App\Entity\TransportEnvelope;
use App\Entity\TransportGroup;
use App\Entity\TransportProperty;
use App\Entity\TransportProtocol;
use App\Form\TransportGroupType;
use App\Form\TransportModel;
use App\Form\TransportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TransportController
 * @package App\Controller
 */
class TransportController extends AbstractController
{
    use DatabaseTrait;

    public function createGroup(Request $request)
    {
        $form = $this->createForm( TransportGroupType::class );
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ) {
            dump($form->getData());
        }
        return $form;
    }

    public function createTransport(Request $request)
    {
        $form = $this->createForm( TransportType::class );
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ) {

            /** @var TransportModel $transportModel */
            $transportModel = $form->getData();
            $transportProperty = new TransportProperty();
            $transportProperty->setHost($transportModel->transportPropertyHost);
            $transportProperty->setPort($transportModel->transportPropertyPort);
            $transportProperty->setUsername($transportModel->transportPropertyUsername);
            $transportProperty->setPassword($transportModel->transportPropertyPassword);
            $managerProperty = $this->getObjectManager(TransportProperty::class);
            $managerProperty->persist($transportProperty);
            $managerProperty->flush();

            $transport = new Transport();
            $transport->setName($transportModel->transportName);
            $transport->setDescription($transportModel->transportDescription);
            $transport->setTransportProtocol( $transportModel->transportProtocol );
            $transport->setTransportEncryption( $transportModel->transportEncryption );
            $transport->setTransportProperty($transportProperty);
            $managerTransport = $this->getObjectManager(Transport::class);
            $managerTransport->persist($transport);
            $managerTransport->flush();
        }

        return $form;
    }

    /**
     * @Route("/transport", name="transport")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $formTransport = $this->createTransport($request);
        $formGroup = $this->createGroup($request);

        $transportProtocols = $this->getObjectRepository(TransportProtocol::class)->findAll();
        $transportEnvelopes = $this->getObjectRepository(TransportEnvelope::class)->findAll();
        $transportEncryptions = $this->getObjectRepository(TransportEncryption::class)->findAll();

        $transports = $this->getObjectRepository(Transport::class)->findAll();
        $transportGroups = $this->getObjectRepository(TransportGroup::class)->findAll();
        $transportProperties = $this->getObjectRepository(TransportProperty::class)->findAll();

        return $this->render('transport/index.html.twig', [
            'formTransport' => $formTransport->createView(),
            'formGroup' => $formGroup->createView(),
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
