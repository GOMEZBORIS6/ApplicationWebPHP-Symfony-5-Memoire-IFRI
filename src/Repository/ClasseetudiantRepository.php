<?php

namespace App\Repository;

use App\Entity\Classeetudiant;
use App\Entity\Filiere;
use App\Entity\Niveau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Classeetudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classeetudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classeetudiant[]    findAll()
 * @method Classeetudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseetudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classeetudiant::class);
    }

    // SELECT libfiliere,libniveau FROM filiere,niveau INNER JOIN classeetudiant
    //  WHERE classeetudiant.filiere_id = filiere.idfiliere AND classeetudiant.niveau_id= niveau.idniveau;

    // public function testQuery()
    // {
    //     $query = $this->createQueryBuilder('c');
    //     $query
    //         ->select('libfiliere,libniveau')
    //         ->from('Niveau','Filiere')
    //         ->innerJoin('Cla','c')
    //         ->where('Filiere.idfiliere like c.filiere_id')
    //         ->andWhere('Niveau.idniveau like c.niveau_id');
            
    //         return ($query->getQuery()->getResult());
    // }

    // /**
    //  * @return Classeetudiant[] Returns an array of Classeetudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Classeetudiant
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
