<?php

namespace App\Repository;

use App\Entity\VoyageArchive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VoyageArchive|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoyageArchive|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoyageArchive[]    findAll()
 * @method VoyageArchive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageArchiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoyageArchive::class);
    }

    // /**
    //  * @return VoyageArchive[] Returns an array of VoyageArchive objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VoyageArchive
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
