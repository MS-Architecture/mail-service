<?php

namespace App\DataFixtures;

use App\Entity\TransportProtocol;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TransportProtocolFixtures
 * @package App\DataFixtures
 */
class TransportProtocolFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $transportProtocol = new TransportProtocol();
        $transportProtocol->setName(TransportProtocol::PROTOCOL_SMTP);
        $transportProtocol->setDescription('Smtp Protocol');
        $manager->persist($transportProtocol);

        $this->addReference( TransportProtocol::PROTOCOL_SMTP, $transportProtocol );

        $transportProtocol = new TransportProtocol();
        $transportProtocol->setName(TransportProtocol::PROTOCOL_NULL);
        $transportProtocol->setDescription('NULL Protocol');
        $manager->persist($transportProtocol);

        $this->addReference( TransportProtocol::PROTOCOL_NULL, $transportProtocol );

        $manager->flush();
    }
}
