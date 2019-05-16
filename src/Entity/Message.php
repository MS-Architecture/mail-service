<?php

namespace App\Entity;

use App\Adapter\MessageAdapter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message extends AbstractEntity
{
    use LifeCycleTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MessageStatus", inversedBy="messages", fetch="EAGER")
     */
    private $messageStatus;

    /**
     * @ORM\Column(type="string")
     */
    private $message;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $messageError;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $messageLog;

    /**
     * @return MessageStatus|null
     */
    public function getMessageStatus(): ?MessageStatus
    {
        return $this->messageStatus;
    }

    /**
     * @param MessageStatus|null $messageStatus
     * @return Message
     */
    public function setMessageStatus(?MessageStatus $messageStatus): self
    {
        $this->messageStatus = $messageStatus;

        return $this;
    }

    /**
     * @return MessageAdapter|null
     */
    public function getMessage(): ?MessageAdapter
    {
        return unserialize($this->message);
    }

    /**
     * @param MessageAdapter $message
     * @return Message
     */
    public function setMessage(MessageAdapter $message): self
    {
        $this->message = serialize($message);

        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getMessageError()
    {
        return json_decode($this->messageError);
    }

    /**
     * @param mixed $messageError
     * @return Message
     */
    public function setMessageError($messageError): self
    {
        $this->messageError = json_encode($messageError);

        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getMessageLog()
    {
        return json_decode($this->messageLog);
    }

    /**
     * @param mixed $messageLog
     * @return Message
     */
    public function setMessageLog($messageLog): self
    {
        $this->messageLog = json_encode($messageLog);

        return $this;
    }
}
