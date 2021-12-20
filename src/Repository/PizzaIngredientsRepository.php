<?php

namespace App\Repository;

use App\Entity\PizzaIngredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PizzaIngredients|null find($id, $lockMode = null, $lockVersion = null)
 * @method PizzaIngredients|null findOneBy(array $criteria, array $orderBy = null)
 * @method PizzaIngredients[]    findAll()
 * @method PizzaIngredients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PizzaIngredientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PizzaIngredients::class);
    }

    // /**
    //  * @return PizzaIngredients[] Returns an array of PizzaIngredients objects
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
    public function findOneBySomeField($value): ?PizzaIngredients
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
