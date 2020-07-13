<?php

namespace App\Repository;

use App\Entity\MagasinStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MagasinStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method MagasinStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method MagasinStock[]    findAll()
 * @method MagasinStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MagasinStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MagasinStock::class);
    }

    // /**
    //  * @return MagasinStock[] Returns an array of MagasinStock objects
    //  */
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
    public function findOneBySomeField($value): ?MagasinStock
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
