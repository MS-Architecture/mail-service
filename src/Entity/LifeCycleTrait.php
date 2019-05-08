<?php

namespace App\Entity;

use DateTime;
use Exception;

/**
 * Trait LifeCycleTrait
 * @package App\Entity
 */
trait LifeCycleTrait
{
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $entityCreate = null;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $entityUpdate = null;

    /**
     * @return DateTime|null
     */
    public function getEntityCreate(): ?DateTime
    {
        return $this->entityCreate;
    }

    /**
     * @return DateTime|null
     */
    public function getEntityUpdate(): ?DateTime
    {
        return $this->entityUpdate;
    }

    /**
     * @ORM\PrePersist
     * @throws Exception
     */
    final public function lifecycleCreate(): self
    {
        if (empty($this->entityCreate)) {
            $this->entityCreate = new DateTime("now");
        }
        return $this;
    }

    /**
     * @ORM\PreUpdate
     * @throws Exception
     */
    final public function lifecycleUpdate(): self
    {
        $this->entityUpdate = new DateTime("now");
        return $this;
    }
}
