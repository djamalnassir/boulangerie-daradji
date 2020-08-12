<?php

namespace App\Repository;

use App\Entity\DetailProduitFini;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailProduitFini|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailProduitFini|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailProduitFini[]    findAll()
 * @method DetailProduitFini[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailProduitFiniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailProduitFini::class);
    }

    // /**
    //  * @return DetailProduitFini[] Returns an array of DetailProduitFini objects
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
    public function findOneBySomeField($value): ?DetailProduitFini
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
