<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransportEnvelopeRepository")
 */
class TransportEnvelope extends AbstractEntity
{
    const ENVELOPE_SIMPLE = 'ENVELOPE_SIMPLE';
    const ENVELOPE_BALANCED = 'ENVELOPE_BALANCED';
    const ENVELOPE_FAILOVER = 'ENVELOPE_FAILOVER';

    const PROPERTY_NAME = 'name';
    const PROPERTY_DESCRIPTION = 'description';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TransportGroup", mappedBy="transportEnvelope")
     */
    private $transportGroups;

    public function __construct()
    {
        $this->transportGroups = new ArrayCollection();
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
     * @return TransportEnvelope
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
     * @param string|null $description
     * @return TransportEnvelope
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
     * @return TransportEnvelope
     */
    public function addTransportGroup(TransportGroup $transportGroup): self
    {
        if (!$this->transportGroups->contains($transportGroup)) {
            $this->transportGroups[] = $transportGroup;
            $transportGroup->setTransportEnvelope($this);
        }

        return $this;
    }

    /**
     * @param TransportGroup $transportGroup
     * @return TransportEnvelope
     */
    public function removeTransportGroup(TransportGroup $transportGroup): self
    {
        if ($this->transportGroups->contains($transportGroup)) {
            $this->transportGroups->removeElement($transportGroup);
            // set the owning side to null (unless already changed)
            if ($transportGroup->getTransportEnvelope() === $this) {
                $transportGroup->setTransportEnvelope(null);
            }
        }

        return $this;
    }
}
