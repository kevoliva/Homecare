<?php

namespace App\Repository;

use App\Entity\Alerte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Alerte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alerte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alerte[]    findAll()
 * @method Alerte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlerteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alerte::class);
    }

    // /**
    //  * @return Alerte[] Returns an array of Alerte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alerte
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByIdBien($idBien)
   {
       return $this->createQueryBuilder('a')
           ->join('a.bien', 'b')
           ->andWhere('b.id = :idBien')
           ->setParameter('idBien', $idBien)
           ->orderBy('a.libelle', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findByIdBienOrdreDesalphabetique($idBien)
  {
      return $this->createQueryBuilder('a')
          ->join('a.bien', 'b')
          ->andWhere('b.id = :idBien')
          ->setParameter('idBien', $idBien)
          ->orderBy('a.libelle', 'DESC')
          ->getQuery()
          ->getResult()
      ;
  }

  public function findByIdBienRecent($idBien)
 {
     return $this->createQueryBuilder('a')
         ->join('a.bien', 'b')
         ->andWhere('b.id = :idBien')
         ->setParameter('idBien', $idBien)
         ->orderBy('a.laDate', 'DESC')
         ->getQuery()
         ->getResult()
     ;
 }

 public function findByIdBienAncien($idBien)
{
    return $this->createQueryBuilder('a')
        ->join('a.bien', 'b')
        ->andWhere('b.id = :idBien')
        ->setParameter('idBien', $idBien)
        ->orderBy('a.laDate', 'ASC')
        ->getQuery()
        ->getResult()
    ;
}
}
