<?php

namespace App\Repository;

use App\Entity\BinHistoric;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BinHistoric|null find($id, $lockMode = null, $lockVersion = null)
 * @method BinHistoric|null findOneBy(array $criteria, array $orderBy = null)
 * @method BinHistoric[]    findAll()
 * @method BinHistoric[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BinHistoricRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BinHistoric::class);
    }

    // /**
    //  * @return BinHistoric[] Returns an array of BinHistoric objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BinHistoric
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
