<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransportRepository")
 */
class Transport extends AbstractEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TransportGroup", inversedBy="transports")
     */
    private $transportGroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TransportType", inversedBy="transports")
     */
    private $transportType;

    /**
     * @return TransportGroup|null
     */
    public function getTransportGroup(): ?TransportGroup
    {
        return $this->transportGroup;
    }

    /**
     * @param TransportGroup|null $transportGroup
     * @return Transport
     */
    public function setTransportGroup(?TransportGroup $transportGroup): self
    {
        $this->transportGroup = $transportGroup;

        return $this;
    }

    /**
     * @return TransportType|null
     */
    public function getTransportType(): ?TransportType
    {
        return $this->transportType;
    }

    /**
     * @param TransportType|null $transportType
     * @return Transport
     */
    public function setTransportType(?TransportType $transportType): self
    {
        $this->transportType = $transportType;

        return $this;
    }
}
