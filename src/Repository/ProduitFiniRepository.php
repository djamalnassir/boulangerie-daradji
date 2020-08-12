<?php

namespace App\Repository;

use App\Entity\ProduitFini;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitFini|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitFini|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitFini[]    findAll()
 * @method ProduitFini[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitFiniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitFini::class);
    }

    // /**
    //  * @return ProduitFini[] Returns an array of ProduitFini objects
    //  */
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
    public function findOneBySomeField($value): ?ProduitFini
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
