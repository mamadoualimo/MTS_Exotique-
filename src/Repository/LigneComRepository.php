<?php

namespace App\Repository;

use App\Entity\LigneCom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LigneCom|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneCom|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneCom[]    findAll()
 * @method LigneCom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneComRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneCom::class);
    }

    // /**
    //  * @return LigneCom[] Returns an array of LigneCom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LigneCom
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
