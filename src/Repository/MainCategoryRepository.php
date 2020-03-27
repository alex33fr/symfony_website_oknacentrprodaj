<?php

namespace App\Repository;

use App\Entity\MainCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method MainCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainCategory[]    findAll()
 * @method MainCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainCategory::class);
    }

    /**
     * @param $value
     * @return MainCategory|null Returns an array of MainCategory objects
     */
    public function findByCategory($value)
    {
        return $this->createQueryBuilder('m')
            ->Where('m.id = :val')
            ->setParameter('val', $value)
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $value
     * @return MainCategory|null Returns an array of MainCategory objects
     * @throws NonUniqueResultException
     */
    public function findTitleByCategory($value)
    {
        return $this->createQueryBuilder('m')
            ->Where('m.id = :val')
            ->setParameter('val', $value)
            ->setMaxResults(100)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    // /**
    //  * @return MainCategory[] Returns an array of MainCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MainCategory
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
