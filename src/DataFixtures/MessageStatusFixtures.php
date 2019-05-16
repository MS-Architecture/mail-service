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
        $messageStatus->setDescription('Waiting');
        $manager->persist($messageStatus);

        $messageStatus = new MessageStatus();
        $messageStatus->setName(MessageStatus::STATUS_SENDING);
        $messageStatus->setDescription('Sending');
        $manager->persist($messageStatus);

        $messageStatus = new MessageStatus();
        $messageStatus->setName(MessageStatus::STATUS_SUCCESS);
        $messageStatus->setDescription('Success');
        $manager->persist($messageStatus);

        $messageStatus = new MessageStatus();
        $messageStatus->setName(MessageStatus::STATUS_FAILED);
        $messageStatus->setDescription('Failed');
        $manager->persist($messageStatus);

        $manager->flush();
    }
}
