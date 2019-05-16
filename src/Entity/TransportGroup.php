<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransportGroupRepository")
 */
class TransportGroup extends AbstractEntity
{
    const PROPERTY_NAME = 'name';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TransportEnvelope", inversedBy="transportGroups")
     */
    private $transportEnvelope;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Transport", inversedBy="transportGroups")
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
     * @return TransportGroup
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
     * @return TransportGroup
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return TransportEnvelope|null
     */
    public function getTransportEnvelope(): ?TransportEnvelope
    {
        return $this->transportEnvelope;
    }

    /**
     * @param TransportEnvelope|null $transportEnvelope
     * @return TransportGroup
     */
    public function setTransportEnvelope(?TransportEnvelope $transportEnvelope): self
    {
        $this->transportEnvelope = $transportEnvelope;

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
     * @return TransportGroup
     */
    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
        }

        return $this;
    }

    /**
     * @param Transport $transport
     * @return TransportGroup
     */
    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->contains($transport)) {
            $this->transports->removeElement($transport);
        }

        return $this;
    }
}
