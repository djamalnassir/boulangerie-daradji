<?php

namespace App\Repository;

use App\Entity\MatierePremiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatierePremiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatierePremiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatierePremiere[]    findAll()
 * @method MatierePremiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatierePremiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatierePremiere::class);
    }

    // /**
    //  * @return MatierePremiere[] Returns an array of MatierePremiere objects
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
    public function findOneBySomeField($value): ?MatierePremiere
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
