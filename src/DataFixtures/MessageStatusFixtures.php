<?php

namespace App\DataFixtures;

use App\Entity\MessageStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class MessageStatusFixtures
 * @package App\DataFixtures
 */
class MessageStatusFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $messageStatus = new MessageStatus();
        $messageStatus->setName(MessageStatus::STATUS_WAITING);
        $manager->persist($messageStatus);

        $messageStatus = new MessageStatus();
        $messageStatus->setName(MessageStatus::STATUS_SENDING);
        $manager->persist($messageStatus);

        $messageStatus = new MessageStatus();
        $messageStatus->setName(MessageStatus::STATUS_SUCCESS);
        $manager->persist($messageStatus);

        $messageStatus = new MessageStatus();
        $messageStatus->setName(MessageStatus::STATUS_FAILED);
        $manager->persist($messageStatus);

        $manager->flush();
    }
}
