<?php

namespace App\Repository;

use App\Entity\CityBin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CityBin|null find($id, $lockMode = null, $lockVersion = null)
 * @method CityBin|null findOneBy(array $criteria, array $orderBy = null)
 * @method CityBin[]    findAll()
 * @method CityBin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityBinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CityBin::class);
    }

    // /**
    //  * @return CityBin[] Returns an array of CityBin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CityBin
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
