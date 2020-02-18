<?php

namespace App\Repository;

use App\Entity\ContractField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContractField|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractField|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractField[]    findAll()
 * @method ContractField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractField::class);
    }

    // /**
    //  * @return ContractField[] Returns an array of ContractField objects
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
    public function findOneBySomeField($value): ?ContractField
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
