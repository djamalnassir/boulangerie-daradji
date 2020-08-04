<?php

namespace App\Repository;

use App\Entity\Appro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Appro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appro[]    findAll()
 * @method Appro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApproRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appro::class);
    }

    // /**
    //  * @return Appro[] Returns an array of Appro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Appro
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
