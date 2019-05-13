<?php

namespace App\DataFixtures;

use App\Entity\TransportType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TransportTypeFixtures
 * @package App\DataFixtures
 */
class TransportTypeFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $transportType = new TransportType();
        $transportType->setName(TransportType::TYPE_NULL);
        $manager->persist($transportType);

        $transportType = new TransportType();
        $transportType->setName(TransportType::TYPE_SMTP);
        $manager->persist($transportType);

        $transportType = new TransportType();
        $transportType->setName(TransportType::TYPE_BALANCED);
        $manager->persist($transportType);

        $transportType = new TransportType();
        $transportType->setName(TransportType::TYPE_FAILOVER);
        $manager->persist($transportType);

        $manager->flush();
    }
}
