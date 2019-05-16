<?php

namespace App\Repository;

use App\Entity\TransportEnvelope;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TransportEnvelope|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransportEnvelope|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransportEnvelope[]    findAll()
 * @method TransportEnvelope[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportEnvelopeRepository extends ServiceEntityRepository
{
    /**
     * TransportEnvelopeRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TransportEnvelope::class);
    }

    // /**
    //  * @return TransportEnvelope[] Returns an array of TransportEnvelope objects
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
    public function findOneBySomeField($value): ?TransportEnvelope
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
