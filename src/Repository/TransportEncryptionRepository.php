<?php

namespace App\Repository;

use App\Entity\TransportEncryption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TransportEncryption|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransportEncryption|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransportEncryption[]    findAll()
 * @method TransportEncryption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportEncryptionRepository extends ServiceEntityRepository
{
    /**
     * TransportEncryptionRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TransportEncryption::class);
    }

    // /**
    //  * @return TransportEncryption[] Returns an array of TransportEncryption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TransportEncryption
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
