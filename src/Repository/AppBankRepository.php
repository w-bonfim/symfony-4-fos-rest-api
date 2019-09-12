<?php

namespace App\Repository;

use App\Entity\AppBank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AppBank|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppBank|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppBank[]    findAll()
 * @method AppBank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppBankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppBank::class);
    }
 
    public function findBankIn($fields)
    {
       return $this->createQueryBuilder('b')
                ->where('b.id in(:ids)')
                ->setParameter('ids', array_values($fields))
                ->getQuery()
                ->getResult();
    }

}
