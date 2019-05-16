<?php

namespace App\DataFixtures;

use App\Entity\TransportEncryption;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TransportEncryptionFixtures
 * @package App\DataFixtures
 */
class TransportEncryptionFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $transportEncryption = new TransportEncryption();
        $transportEncryption->setName(TransportEncryption::ENCRYPTION_NONE);
        $transportEncryption->setDescription('No Encryption');
        $manager->persist($transportEncryption);

        $this->addReference( TransportEncryption::ENCRYPTION_NONE, $transportEncryption );

        $transportEncryption = new TransportEncryption();
        $transportEncryption->setName(TransportEncryption::ENCRYPTION_SSL);
        $transportEncryption->setDescription('SSL Encryption');
        $manager->persist($transportEncryption);

        $this->addReference( TransportEncryption::ENCRYPTION_SSL, $transportEncryption );

        $transportEncryption = new TransportEncryption();
        $transportEncryption->setName(TransportEncryption::ENCRYPTION_TLS);
        $transportEncryption->setDescription('TLS Encryption');
        $manager->persist($transportEncryption);

        $this->addReference( TransportEncryption::ENCRYPTION_TLS, $transportEncryption );

        $manager->flush();
    }
}
