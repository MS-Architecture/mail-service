<?php


namespace App\Controller;


use App\Entity\MessageStatus;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Trait DatabaseTrait
 * @package App\Controller
 */
trait DatabaseTrait
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * MessageController constructor.
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @param string $status
     * @return MessageStatus|null
     */
    protected function fetchStatus(string $status = MessageStatus::STATUS_WAITING)
    {
        $statusRepository = $this->getObjectRepository(MessageStatus::class);
        /** @var MessageStatus $messageStatus */
        $messageStatus = $statusRepository->findOneBy([MessageStatus::PROPERTY_NAME => $status]);
        return $messageStatus;
    }

    /**
     * @param string $class
     * @return ObjectRepository
     */
    protected function getObjectRepository(string $class)
    {
        return $this->getObjectManager($class)->getRepository($class);
    }

    /**
     * @param string $class
     * @return ObjectManager|null
     */
    protected function getObjectManager(string $class)
    {
        return $this->managerRegistry->getManagerForClass($class);
    }
}