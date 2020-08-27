<?php

namespace App\Repository;

use App\Entity\CampingLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CampingLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampingLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampingLike[]    findAll()
 * @method CampingLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampingLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampingLike::class);
    }

    // /**
    //  * @return CampingLike[] Returns an array of CampingLike objects
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
    public function findOneBySomeField($value): ?CampingLike
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
