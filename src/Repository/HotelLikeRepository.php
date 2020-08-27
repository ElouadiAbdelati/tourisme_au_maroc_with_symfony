<?php

namespace App\Repository;

use App\Entity\HotelLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HotelLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelLike[]    findAll()
 * @method HotelLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelLike::class);
    }

    // /**
    //  * @return HotelLike[] Returns an array of HotelLike objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HotelLike
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
