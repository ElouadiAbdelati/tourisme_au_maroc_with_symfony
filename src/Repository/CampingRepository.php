<?php

namespace App\Repository;

use App\Entity\Camping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Camping|null find($id, $lockMode = null, $lockVersion = null)
 * @method Camping|null findOneBy(array $criteria, array $orderBy = null)
 * @method Camping[]    findAll()
 * @method Camping[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Camping::class);
    }

    // /**
    //  * @return Camping[] Returns an array of Camping objects
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
    public function findOneBySomeField($value): ?Camping
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
