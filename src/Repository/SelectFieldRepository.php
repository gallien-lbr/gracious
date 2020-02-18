<?php

namespace App\Repository;

use App\Entity\SelectField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SelectField|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectField|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectField[]    findAll()
 * @method SelectField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectField::class);
    }

    // /**
    //  * @return SelectField[] Returns an array of SelectField objects
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
    public function findOneBySomeField($value): ?SelectField
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
