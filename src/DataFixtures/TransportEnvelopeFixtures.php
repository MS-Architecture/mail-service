<?php

namespace App\DataFixtures;

use App\Entity\TransportEnvelope;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TransportEnvelopeFixtures
 * @package App\DataFixtures
 */
class TransportEnvelopeFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $transportEnvelope = new TransportEnvelope();
        $transportEnvelope->setName(TransportEnvelope::ENVELOPE_SIMPLE);
        $transportEnvelope->setDescription('Simple Transport');
        $manager->persist($transportEnvelope);

        $this->addReference( TransportEnvelope::ENVELOPE_SIMPLE, $transportEnvelope );

        $transportEnvelope = new TransportEnvelope();
        $transportEnvelope->setName(TransportEnvelope::ENVELOPE_BALANCED);
        $transportEnvelope->setDescription('Balanced Transport');
        $manager->persist($transportEnvelope);

        $this->addReference( TransportEnvelope::ENVELOPE_BALANCED, $transportEnvelope );

        $transportEnvelope = new TransportEnvelope();
        $transportEnvelope->setName(TransportEnvelope::ENVELOPE_FAILOVER);
        $transportEnvelope->setDescription('Failover Transport');
        $manager->persist($transportEnvelope);

        $this->addReference( TransportEnvelope::ENVELOPE_FAILOVER, $transportEnvelope );

        $manager->flush();
    }
}
