<?php

namespace App\Repository;

use App\Entity\Programmation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Programmation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Programmation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Programmation[]    findAll()
 * @method Programmation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgrammationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Programmation::class);
    }

    // /**
    //  * @return Programmation[] Returns an array of Programmation objects
    //  */
    
    public function emploi() {
        $query =  $this->createQueryBuilder('p')->orderBy('p.classeetudiant, p.createdAt','DESC');
        return $query->getQuery()->getResult();
    }
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
    public function findOneBySomeField($value): ?Programmation
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
