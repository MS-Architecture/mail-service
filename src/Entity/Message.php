<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message extends AbstractEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MessageStatus", inversedBy="messages")
     */
    private $messageStatus;

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
}
