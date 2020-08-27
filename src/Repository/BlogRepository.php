<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    // /**
    //  * @return Blog[] Returns an array of Blog objects
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
    public function findOneBySomeField($value): ?Blog
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByContent($val)
    {     
        return  $this->createQueryBuilder('b')
        ->where(' b.content like :val or  b.title like :val')
        ->andWhere('b.published=1')
        ->setParameter('val','%'.$val.'%')
        ->getQuery()
        ->getResult();
    }

    public function findBlogByPublished()
    {     
        return  $this->createQueryBuilder('b' )
        ->where('b.published=1')
        ->getQuery()
        ->getResult();
    }

    public function findBlogByCategorieAndPublished($categorie)
    {     
        return  $this->createQueryBuilder('b' )
        ->where('b.categorie=:id and b.published=1')
        ->setParameter('id',$categorie->getId())
        ->getQuery()
        ->getResult();
    }

    public function bestBlogs()
    {     
        return  $this->createQueryBuilder('b' )
        ->join('App\Entity\CommentaireBlog ','c')
        ->where(' b.published=1 and c.blog=b.id   ')
        ->groupBy('b.id')
        ->select('b ,COUNT(b.id) as nombreCommentaires')
        ->orderBy('nombreCommentaires', 'DESC')
        ->setMaxResults(3)
        ->getQuery()
        ->getResult();
    }

 
}
