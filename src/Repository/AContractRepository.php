<?php

namespace App\Repository;

use App\Entity\AContract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AContract|null find($id, $lockMode = null, $lockVersion = null)
 * @method AContract|null findOneBy(array $criteria, array $orderBy = null)
 * @method AContract[]    findAll()
 * @method AContract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AContract::class);
    }

    // /**
    //  * @return AContract[] Returns an array of AContract objects
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
    public function findOneBySomeField($value): ?AContract
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
