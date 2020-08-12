<?php

namespace App\Repository;

use App\Entity\DetailProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailProduction[]    findAll()
 * @method DetailProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailProduction::class);
    }

    // /**
    //  * @return DetailProduction[] Returns an array of DetailProduction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailProduction
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
