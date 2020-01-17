<?php

namespace App\Repository;

use App\Entity\ReportHistoric;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReportHistoric|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportHistoric|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportHistoric[]    findAll()
 * @method ReportHistoric[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportHistoricRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportHistoric::class);
    }

    // /**
    //  * @return ReportHistoric[] Returns an array of ReportHistoric objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReportHistoric
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
