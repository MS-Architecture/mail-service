<?php

namespace App\Repository;

use App\Entity\TransportProtocol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TransportProtocol|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransportProtocol|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransportProtocol[]    findAll()
 * @method TransportProtocol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportProtocolRepository extends ServiceEntityRepository
{
    /**
     * TransportProtocolRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TransportProtocol::class);
    }

    // /**
    //  * @return TransportProtocol[] Returns an array of TransportProtocol objects
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
    public function findOneBySomeField($value): ?TransportProtocol
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
