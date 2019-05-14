<?php

namespace App\Controller;

use App\Adapter\DefaultTransportAdapter;
use App\Adapter\MessageAdapter;
use App\Adapter\Transport\NullAdapter;
use App\Adapter\Transport\SmtpAdapter;
use App\Entity\Message;
use App\Entity\MessageStatus;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Class MessageController
 * @package App\Controller
 */
class MessageController extends AbstractController
{
    use StatusTrait;

    /**
     * @Route("/messages/send", name="messages.send")
     */
    public function sendMessages()
    {
        $statusWaiting = $this->fetchStatus(MessageStatus::STATUS_WAITING);
        $statusSending = $this->fetchStatus(MessageStatus::STATUS_SENDING);
        $statusFailed = $this->fetchStatus(MessageStatus::STATUS_FAILED);
        $statusSuccess = $this->fetchStatus(MessageStatus::STATUS_SUCCESS);

        $messageManager = $this->getObjectManager(Message::class);
        /** @var Message[] $messages */
        $messages = $statusWaiting->getMessages()->toArray();

        foreach ($messages as $message) {
            $message->setMessageError(null);
            $message->setMessageLog(null);
            $message->setMessageStatus($statusSending);
            $messageManager->persist($message);
            $messageManager->flush();

            switch (rand(0,1)) {
                case 0:
                    $transportAdapter = new DefaultTransportAdapter(
                        new SmtpAdapter()
                    );
                    break;
                default:
                    $transportAdapter = new DefaultTransportAdapter(
                        new NullAdapter()
                    );
            }

            try {
                if (($response = $transportAdapter->send($message->getMessage(), $errors)) == 0) {
                    $message->setMessageStatus($statusFailed);
                    $message->setMessageLog($transportAdapter->getLog());
                    if (!empty($errors)) {
                        $message->setMessageError($errors);
                    }
                    $messageManager->persist($message);
                    $messageManager->flush();
                } else {
                    $message->setMessageStatus($statusSuccess);
                    $message->setMessageLog($transportAdapter->getLog());
                    $messageManager->persist($message);
                    $messageManager->flush();
                }
            } catch (Throwable $throwable) {
                $message->setMessageStatus($statusFailed);
                $message->setMessageLog($transportAdapter->getLog());
                $errors = ['Server error', get_class($transportAdapter)];
                $transports = $transportAdapter->getTransports();
                foreach( $transports as $transport ) {
                    $errors[] = get_class($transport);
                }
                $errors[] = utf8_encode($throwable->getMessage());
                $message->setMessageError($errors);
                $messageManager->persist($message);
                $messageManager->flush();
            }
        }

        return new Response('<html lang="en"><head><title></title></head><body></body></html>');
//        return $this->redirectToRoute('welcome.status');
    }

    /**
     * @Route("/message/create/plain-text", name="message.create.plain-text")
     */
    public function createPlainText()
    {

        $seed = count($this->getObjectRepository(Message::class)->findAll());
        $messageAdapter = $this->createFakeMessage($seed);

        $messageManager = $this->getObjectManager(Message::class);

        $messageStatus = $this->fetchStatus(MessageStatus::STATUS_WAITING);

        $message = new Message();
        $message->setMessageStatus($messageStatus);
        $message->setMessage($messageAdapter);

        $messageManager->persist($message);
        $messageManager->flush();

        return $this->redirectToRoute('welcome.status');
    }

    /**
     * @param int $seed
     * @return MessageAdapter
     */
    private function createFakeMessage(int $seed)
    {
        $faker = Factory::create();
        $faker->seed($seed);

        $messageAdapter = new MessageAdapter();

        $messageAdapter->setSubject($faker->text);
        $messageAdapter->setBody(implode($faker->paragraphs));

        $messageAdapter->setTo('gerdchristian.kunze@googlemail.com');
        $messageAdapter->setFrom('drupie@kuw-informatik.de');
        $messageAdapter->setReplyTo('drupie@kuw-informatik.de');
        $messageAdapter->setReturnPath('drupie@kuw-informatik.de');

        return $messageAdapter;
    }
}
