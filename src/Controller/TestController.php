<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Swift_Mailer;
use Swift_MemorySpool;
use Swift_Message;
use Swift_Plugins_AntiFloodPlugin;
use Swift_Plugins_LoggerPlugin;
use Swift_Plugins_Loggers_EchoLogger;
use Swift_Plugins_ThrottlerPlugin;
use Swift_SpoolTransport;
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

        $transport = new Swift_SpoolTransport(
            new Swift_MemorySpool()
        );
        $mailer = new Swift_Mailer($transport);

        $antiFloodPlugin = new Swift_Plugins_AntiFloodPlugin();
        $throttlerPlugin = new Swift_Plugins_ThrottlerPlugin(100);
        $loggerPlugin = new Swift_Plugins_LoggerPlugin(
            new Swift_Plugins_Loggers_EchoLogger()
        );

        $mailer->registerPlugin($antiFloodPlugin);
        $mailer->registerPlugin($throttlerPlugin);
        $mailer->registerPlugin($loggerPlugin);

        $message = new Swift_Message();
        $message->setSubject('Test');
        $message->setBody('Body');
        $message->setFrom('test@local.host');
        $message->setTo('test@local.host');

        $mailer->send($message, $errors);

        dump($mailer,$message,$errors,$transport->getSpool());
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
