<?php

namespace App\Repository;

use App\Entity\TransportGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TransportGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransportGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransportGroup[]    findAll()
 * @method TransportGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportGroupRepository extends ServiceEntityRepository
{
    /**
     * TransportGroupRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TransportGroup::class);
    }

    // /**
    //  * @return TransportGroup[] Returns an array of TransportGroup objects
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
    public function findOneBySomeField($value): ?TransportGroup
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
