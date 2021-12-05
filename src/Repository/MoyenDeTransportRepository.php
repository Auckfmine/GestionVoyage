<?php

namespace App\Repository;

use App\Entity\MoyenDeTransport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MoyenDeTransport|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoyenDeTransport|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoyenDeTransport[]    findAll()
 * @method MoyenDeTransport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoyenDeTransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoyenDeTransport::class);
    }

    // /**
    //  * @return MoyenDeTransport[] Returns an array of MoyenDeTransport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MoyenDeTransport
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}