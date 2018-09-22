<?php

namespace App\Repository;

use App\Entity\MovieRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MovieRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieRating[]    findAll()
 * @method MovieRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRatingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MovieRating::class);
    }

//    /**
//     * @return MovieRating[] Returns an array of MovieRating objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MovieRating
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
