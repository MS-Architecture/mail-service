<?php

namespace App\Controller;

use App\Adapter\MessageAdapter;
use App\Adapter\TransportAdapter;
use App\Entity\Message;
use App\Entity\MessageStatus;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MessageController
 * @package App\Controller
 */
class MessageController extends AbstractController
{
    use DatabaseTrait;


    /**
     * @Route("/messages/update/sending-to-waiting", name="messages.update.sending.to.waiting")
     * @return RedirectResponse
     */
    public function setStatusSendingToWaiting()
    {
        $this->updateStatus(
            $this->fetchStatus(MessageStatus::STATUS_SENDING),
            $this->fetchStatus(MessageStatus::STATUS_WAITING)
        );
        return $this->redirectToRoute('welcome.status');
    }

    /**
     * @param MessageStatus $fromStatus
     * @param MessageStatus $toStatus
     */
    private function updateStatus(MessageStatus $fromStatus, MessageStatus $toStatus)
    {
        $messageManager = $this->getObjectManager(Message::class);
        /** @var Message[] $messages */
        $messages = $fromStatus->getMessages()->toArray();
        foreach ($messages as $message) {
            $message->setMessageStatus($toStatus);
            $messageManager->persist($message);
        }
        $messageManager->flush();
    }

    /**
     * @Route("/messages/update/failed-to-waiting", name="messages.update.failed.to.waiting")
     * @return RedirectResponse
     */
    public function setStatusFailedToWaiting()
    {
        $this->updateStatus(
            $this->fetchStatus(MessageStatus::STATUS_FAILED),
            $this->fetchStatus(MessageStatus::STATUS_WAITING)
        );
        return $this->redirectToRoute('welcome.status');
    }

    /**
     * @Route("/messages/update/success-to-waiting", name="messages.update.success.to.waiting")
     * @return RedirectResponse
     */
    public function setStatusSuccessToWaiting()
    {
        $this->updateStatus(
            $this->fetchStatus(MessageStatus::STATUS_SUCCESS),
            $this->fetchStatus(MessageStatus::STATUS_WAITING)
        );
        return $this->redirectToRoute('welcome.status');
    }

    /**
     * @Route("/messages/send", name="messages.send")
     */
    public function sendMessages()
    {
        $statusWaiting = $this->fetchStatus(MessageStatus::STATUS_WAITING);
        $statusSending = $this->fetchStatus(MessageStatus::STATUS_SENDING);
        $statusFailed = $this->fetchStatus(MessageStatus::STATUS_FAILED);
        $statusSuccess = $this->fetchStatus(MessageStatus::STATUS_SUCCESS);

        $transportAdapter = new TransportAdapter();

        $messageManager = $this->getObjectManager(Message::class);
        /** @var Message[] $messages */
        $messages = $statusWaiting->getMessages()->toArray();

        foreach ($messages as $message) {
            $message->setMessageStatus($statusSending);
            $messageManager->persist($message);
            $messageManager->flush();

            if (($response = $transportAdapter->send($message->getMessage(), $errors)) == 0) {
                $message->setMessageStatus($statusFailed);
                if (!empty($errors)) {
                    $message->setMessageError($errors);
                }
                $messageManager->persist($message);
                $messageManager->flush();
            } else {
                $message->setMessageStatus($statusSuccess);
                $messageManager->persist($message);
                $messageManager->flush();
            }
        }

        return $this->redirectToRoute('welcome.status');
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

        $messageAdapter->setTo($faker->email);
        $messageAdapter->setFrom($faker->email);
        $messageAdapter->setReplyTo($faker->email);
        $messageAdapter->setReturnPath($faker->email);

        return $messageAdapter;
    }
}
