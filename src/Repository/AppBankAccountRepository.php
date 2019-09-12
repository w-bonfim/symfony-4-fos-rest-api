<?php

namespace App\Repository;

use App\Entity\AppBankAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AppBankAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppBankAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppBankAccount[]    findAll()
 * @method AppBankAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppBankAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppBankAccount::class);
    }

    public function findBankIn($fields)
    {
       return $this->createQueryBuilder('b')
                ->where('b.id in(:ids)')
                ->setParameter('ids', array_values($fields))
                ->getQuery()
                ->getResult();
    }



    // /**
    //  * @return AppBankAccount[] Returns an array of AppBankAccount objects
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
    public function findOneBySomeField($value): ?AppBankAccount
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
