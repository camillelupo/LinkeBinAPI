<?php

namespace App\Repository;

use App\Entity\UsersBin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UsersBin|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersBin|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersBin[]    findAll()
 * @method UsersBin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersBinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersBin::class);
    }

    // /**
    //  * @return UsersBin[] Returns an array of UsersBin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersBin
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
