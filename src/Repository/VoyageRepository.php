<?php

namespace App\Repository;

use App\Entity\Voyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncode;

/**
 * @method Voyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voyage[]    findAll()
 * @method Voyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voyage::class);
    }

    // /**
    //  * @return Voyage[] Returns an array of Voyage objects
    //  */

    public function findByExampleField($value)
    {
        $result =  $this->createQueryBuilder('voyage')
            ->andWhere('voyage.date_depart = :val')
            ->setParameter('val', $value)
            ->orderBy('voyage.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;






        return $result;
    }

    public function findVoyageByStation($term){
        return $this

            ->createQueryBuilder('voyage')
            ->join('voyage.station_depart', 'station')
            ->where('station.nom_station = :val')
            ->setParameter('val',$term)
            ->getQuery()
            ->getResult();
    }


    public function findVoyageByMoyenDeTransport($term){
        return $this

            ->createQueryBuilder('voyage')
            ->join('voyage.MoyenDeTransport', 'mt')
            ->where('mt.Type = :val')
            ->setParameter('val',$term)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Voyage
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
