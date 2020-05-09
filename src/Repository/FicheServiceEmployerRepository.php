<?php

namespace App\Repository;

use App\Entity\FicheServiceEmployer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FicheServiceEmployer|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheServiceEmployer|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheServiceEmployer[]    findAll()
 * @method FicheServiceEmployer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheServiceEmployerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheServiceEmployer::class);
    }

    // /**
    //  * @return FicheServiceEmployer[] Returns an array of FicheServiceEmployer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheServiceEmployer
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
