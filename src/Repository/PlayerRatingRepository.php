<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PlayerRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PlayerRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerRating[]    findAll()
 * @method PlayerRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRatingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlayerRating::class);
    }

//    /**
//     * @return PlayerRating[] Returns an array of PlayerRating objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlayerRating
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
