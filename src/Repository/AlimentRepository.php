<?php

namespace App\Repository;

use App\Entity\Aliment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Aliment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aliment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aliment[]    findAll()
 * @method Aliment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aliment::class);
    }

    /**
     * Permet de récupérer les aliments de moins de 50 calories
     * 
     * 
     * @return Aliment[] Returns an array of Aliment objects
     */
    public function getAlimentPerProperty($property, $signe,$value)
    {
        return $this->createQueryBuilder('a')
            ->andwhere('a.'. $property. $signe .':val')
            ->setParameter('val', $value )
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Permet de récupérer des aliments en fonction de leurs type
     *
     * @param [string] $value
     * @return void
     */
    public function getAlimentByType($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere("a.type = :val")
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Aliment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
