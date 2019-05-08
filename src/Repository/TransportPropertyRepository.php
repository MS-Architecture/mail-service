<?php

namespace App\Repository;

use App\Entity\TransportProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TransportProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransportProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransportProperty[]    findAll()
 * @method TransportProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportPropertyRepository extends ServiceEntityRepository
{
    /**
     * TransportPropertyRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TransportProperty::class);
    }

    // /**
    //  * @return TransportProperty[] Returns an array of TransportProperty objects
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
    public function findOneBySomeField($value): ?TransportProperty
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
