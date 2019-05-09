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
//    /**
//     * @var SpoolAdapter
//     */
//    private $spoolAdapter;
//
//    public function __construct(SpoolAdapter $spoolAdapter)
//    {
//        $this->spoolAdapter = $spoolAdapter;
//    }

    public function createMail()
    {
        $message = new MessageAdapter();
        $message->setSubject('Test');
        $message->setBody('Body');
        $message->setFrom('test@local.host');
        $message->setTo('test@local.host');

        return $message;
    }

    /**
     * @Route("/test", name="test")
     * @return Response
     */
    public function index()
    {

        $transport = new TransportAdapter(

        );


        $mailer = new MailAdapter($transport);

        $mailer->send($message, $errors);

        dump($mailer, $message, $errors, $transport->getSpool());
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
