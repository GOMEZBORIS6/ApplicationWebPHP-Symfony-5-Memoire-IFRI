<?php

namespace App\Repository;

use App\Entity\Ecue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ecue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecue[]    findAll()
 * @method Ecue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ecue::class);
    }

    // /**
    //  * @return Ecue[] Returns an array of Ecue objects
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
    public function findOneBySomeField($value): ?Ecue
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
