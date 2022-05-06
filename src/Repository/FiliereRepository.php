<?php

namespace App\Repository;

use App\Entity\Classeetudiant;
use App\Entity\Filiere;
use App\Entity\Niveau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Filiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filiere[]    findAll()
 * @method Filiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiliereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filiere::class);
    }

        public function getNiveauByFiliere(){
            $em =$this->getEntityManager();
            $query = $em->createQuery(
                'SELECT a.libfiliere, b.libniveau FROM App\Entity\Filiere a, App\Entity\Niveau b 
                INNER JOIN App\Entity\Classeetudiant c
                 WHERE c.filiereId = a.idfiliere 
                 AND c.niveauId= b.idniveau'
            );
            return $query->getResult();
            // $query=$this->createQueryBuilder('h')
            // ->join('h.filiere','f')
            // ->join('f.niveau','n')
            // ->join('n.classeetudiant','k')
            // ->where('h.')

        }
    //    public function testQuery()
    //   {
        
        
    //  $query = $this->createQueryBuilder('f');
    //      $query
            
    //         ->from(Filiere::class,'j')
    //         ->from(Niveau::class,'k')
    //         ->select('j.libfiliere','k.libniveau')
    //         ->innerJoin(Classeetudiant::class,'c')
    //        ->where('j.idfiliere like c.filiere_id')
    //     ->andWhere('k.idniveau like c.idniveau_id');
            
    //       return ($query->getQuery()->getResult());
    //  }
    // /**
    //  * @return Filiere[] Returns an array of Filiere objects
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
    public function findOneBySomeField($value): ?Filiere
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
