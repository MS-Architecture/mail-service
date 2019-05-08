<?php

namespace App\Controller;

use App\Adapter\MailAdapter;
use App\Adapter\MessageAdapter;
use App\Adapter\SpoolAdapter;
use App\Adapter\TransportAdapter;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     * @param LoggerInterface $logger
     * @return Response
     */
    public function index(LoggerInterface $logger)
    {

        $transport = new TransportAdapter(
            new SpoolAdapter()
        );
        $mailer = new MailAdapter($transport);

        $message = new MessageAdapter();
        $message->setSubject('Test');
        $message->setBody('Body');
        $message->setFrom('test@local.host');
        $message->setTo('test@local.host');

        $mailer->send($message, $errors);

        dump($mailer, $message, $errors, $transport->getSpool());
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
