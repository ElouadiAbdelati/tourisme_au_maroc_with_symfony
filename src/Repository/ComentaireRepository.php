<?php

namespace App\Repository;

use App\Entity\Comentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comentaire[]    findAll()
 * @method Comentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comentaire::class);
    }

    // /**
    //  * @return Comentaire[] Returns an array of Comentaire objects
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
    public function findOneBySomeField($value): ?Comentaire
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
