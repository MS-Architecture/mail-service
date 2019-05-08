<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Element
 *
 * @package SPHERE\System\Database\Fitting
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @return string
     */
    final public function __toString()
    {
        return strval($this->getId());
    }

    /**
     * @return int
     */
    final public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AbstractEntity
     */
    final public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
}
