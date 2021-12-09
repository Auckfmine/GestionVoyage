<?php

namespace App\Repository;

use App\Entity\AbonnementDisponible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbonnementDisponible|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbonnementDisponible|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbonnementDisponible[]    findAll()
 * @method AbonnementDisponible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbonnementDisponibleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbonnementDisponible::class);
    }

    // /**
    //  * @return AbonnementDisponible[] Returns an array of AbonnementDisponible objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AbonnementDisponible
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
