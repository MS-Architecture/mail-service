<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransportProtocolRepository")
 */
class TransportProtocol extends AbstractEntity
{
    const PROTOCOL_NULL = 'PROTOCOL_NULL';
    const PROTOCOL_SMTP = 'PROTOCOL_SMTP';

    const PROPERTY_NAME = 'name';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transport", mappedBy="transportProtocol")
     */
    private $transports;

    public function __construct()
    {
        $this->transports = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return TransportProtocol
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return TransportProtocol
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Transport[]
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    /**
     * @param Transport $transport
     * @return TransportProtocol
     */
    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->setTransportProtocol($this);
        }

        return $this;
    }

    /**
     * @param Transport $transport
     * @return TransportProtocol
     */
    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->contains($transport)) {
            $this->transports->removeElement($transport);
            // set the owning side to null (unless already changed)
            if ($transport->getTransportProtocol() === $this) {
                $transport->setTransportProtocol(null);
            }
        }

        return $this;
    }
}
