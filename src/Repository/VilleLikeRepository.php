<?php

namespace App\Repository;

use App\Entity\VilleLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VilleLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method VilleLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method VilleLike[]    findAll()
 * @method VilleLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VilleLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VilleLike::class);
    }

    // /**
    //  * @return VilleLike[] Returns an array of VilleLike objects
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
    public function findOneBySomeField($value): ?VilleLike
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
