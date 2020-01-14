<?php

namespace App\Repository;

use App\Entity\ProductToSell;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductToSell|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductToSell|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductToSell[]    findAll()
 * @method ProductToSell[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductToSellRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductToSell::class);
    }

    // /**
    //  * @return ProductToSell[] Returns an array of ProductToSell objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductToSell
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
