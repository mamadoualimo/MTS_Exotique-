<?php

namespace App\Repository;

use App\Entity\ShippingAdress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShippingAdress|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingAdress|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingAdress[]    findAll()
 * @method ShippingAdress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingAdressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingAdress::class);
    }

    // /**
    //  * @return ShippingAdress[] Returns an array of ShippingAdress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShippingAdress
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
