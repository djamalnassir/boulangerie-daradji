<?php

namespace App\Repository;

use App\Entity\DetailAppro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailAppro|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailAppro|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailAppro[]    findAll()
 * @method DetailAppro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailApproRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailAppro::class);
    }

    // /**
    //  * @return DetailAppro[] Returns an array of DetailAppro objects
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
    public function findOneBySomeField($value): ?DetailAppro
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
