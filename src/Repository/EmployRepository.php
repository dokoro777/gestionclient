<?php

namespace App\Repository;

use App\Entity\Employ;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Employ|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employ|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employ[]    findAll()
 * @method Employ[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employ::class);
    }

    // /**
    //  * @return Employ[] Returns an array of Employ objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Employ
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
