<?php

namespace App\Repository;

use App\Entity\MatierePremiereCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatierePremiereCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatierePremiereCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatierePremiereCommande[]    findAll()
 * @method MatierePremiereCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatierePremiereCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatierePremiereCommande::class);
    }

    /**
     * @return MatierePremiereCommande[] Returns an array of MatierePremiereCommande objects
     */
    
    public function findByCommandeId($id)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :val')
            ->setParameter('val', $id)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?MatierePremiereCommande
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
