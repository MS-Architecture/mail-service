<?php

namespace App\Controller;


use App\Entity\Message;
use App\Entity\MessageStatus;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Trait StatusTrait
 * @package App\Controller
 */
trait StatusTrait
{
    use DatabaseTrait;

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
            $message->setMessageLog(null);
            $message->setMessageError(null);
            $message->setMessageStatus($toStatus);
            $messageManager->persist($message);
        }
        $messageManager->flush();
    }

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

}
