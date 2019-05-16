<?php

namespace App\DataFixtures;

use App\Entity\Transport;
use App\Entity\TransportEncryption;
use App\Entity\TransportEnvelope;
use App\Entity\TransportGroup;
use App\Entity\TransportProperty;
use App\Entity\TransportProtocol;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $property = new TransportProperty();
        $property->setHost('localhost');
        $property->setPort(25);
        $manager->persist($property);

        /** @var TransportEncryption $encryption */
        $encryption = $this->getReference( TransportEncryption::ENCRYPTION_NONE );
        /** @var TransportProtocol $protocol */
        $protocol = $this->getReference( TransportProtocol::PROTOCOL_NULL );
        $transport = new Transport();
        $transport->setName('Server (localhost)');
        $transport->setDescription('Test');
        $transport->setTransportEncryption($encryption);
        $transport->setTransportProtocol($protocol);
        $transport->setTransportProperty($property);
        $manager->persist($transport);

        /** @var TransportEnvelope $envelope */
        $envelope = $this->getReference( TransportEnvelope::ENVELOPE_SIMPLE );
        $group = new TransportGroup();
        $group->setName('Group (localhost)');
        $group->setDescription('Test');
        $group->setTransportEnvelope( $envelope );
        $group->addTransport($transport);
        $group->addTransport($transport);
        $manager->persist($group);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return array(
            MessageStatusFixtures::class,
            TransportEncryptionFixtures::class,
            TransportEnvelopeFixtures::class,
            TransportProtocolFixtures::class,
        );
    }
}
