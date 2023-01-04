<?php

namespace App\Repository;

use App\Entity\Idea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class IdeaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Idea::class);
    }

    public function findPublishedWithCategory()
    {
        return $this->createQueryBuilder('i')
            ->select('i', 'c')
            ->innerJoin('i.category', 'c')
            ->andWhere('i.isPublished = :published')
            ->setParameter('published', true)
            ->orderBy('i.dateCreated', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('i')
            ->where('i.something = :value')->setParameter('value', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
