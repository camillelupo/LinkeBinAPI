<?php

namespace App\Repository;

use App\Entity\Bin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bin[]    findAll()
 * @method Bin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bin::class);
    }
    

    // /**
    //  * @return Bin[] Returns an array of Bin objects
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
    public function findOneBySomeField($value): ?Bin
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getLastID() {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.created_at', 'DESC')
            ->getQuery();
        return $query->getArrayResult();
    }
    public function getAllBins($id){
         $query =
             $this->createQueryBuilder('b')
                 ->select('b.id','b.coords','b.created_at','b.updated_at')
            ->getQuery();
            return $query->getResult();
    }
    public function getBinByCoords($coord,$coord1){
        return$this->createQueryBuilder('b')
            ->where('b.coords = ST_Point(:val,:val1)')
            ->setParameter(':val',$coord)
            ->setParameter(':val1',$coord1)
            ->getQuery()
            ->getResult();
    }
}
