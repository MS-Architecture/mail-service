<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransportRepository")
 */
class Transport extends AbstractEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TransportProtocol", inversedBy="transports")
     */
    private $transportProtocol;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TransportEncryption", inversedBy="transports")
     */
    private $transportEncryption;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TransportProperty", inversedBy="transports")
     */
    private $transportProperty;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TransportGroup", mappedBy="transports")
     */
    private $transportGroups;

    public function __construct()
    {
        $this->transportGroups = new ArrayCollection();
    }

    /**
     * @return TransportProtocol|null
     */
    public function getTransportProtocol(): ?TransportProtocol
    {
        return $this->transportProtocol;
    }

    /**
     * @param TransportProtocol|null $transportProtocol
     * @return Transport
     */
    public function setTransportProtocol(?TransportProtocol $transportProtocol): self
    {
        $this->transportProtocol = $transportProtocol;

        return $this;
    }

    /**
     * @return TransportEncryption|null
     */
    public function getTransportEncryption(): ?TransportEncryption
    {
        return $this->transportEncryption;
    }

    /**
     * @param TransportEncryption|null $transportEncryption
     * @return Transport
     */
    public function setTransportEncryption(?TransportEncryption $transportEncryption): self
    {
        $this->transportEncryption = $transportEncryption;

        return $this;
    }

    /**
     * @return TransportProperty|null
     */
    public function getTransportProperty(): ?TransportProperty
    {
        return $this->transportProperty;
    }

    /**
     * @param TransportProperty|null $transportProperty
     * @return Transport
     */
    public function setTransportProperty(?TransportProperty $transportProperty): self
    {
        $this->transportProperty = $transportProperty;

        return $this;
    }

    /**
     * @return Collection|TransportGroup[]
     */
    public function getTransportGroups(): Collection
    {
        return $this->transportGroups;
    }

    /**
     * @param TransportGroup $transportGroup
     * @return Transport
     */
    public function addTransportGroup(TransportGroup $transportGroup): self
    {
        if (!$this->transportGroups->contains($transportGroup)) {
            $this->transportGroups[] = $transportGroup;
            $transportGroup->addTransport($this);
        }

        return $this;
    }

    /**
     * @param TransportGroup $transportGroup
     * @return Transport
     */
    public function removeTransportGroup(TransportGroup $transportGroup): self
    {
        if ($this->transportGroups->contains($transportGroup)) {
            $this->transportGroups->removeElement($transportGroup);
            $transportGroup->removeTransport($this);
        }

        return $this;
    }
}
