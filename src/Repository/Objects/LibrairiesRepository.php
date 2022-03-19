<?php

namespace App\Repository\Objects;

use App\Entity\Objects\Librairies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Librairies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Librairies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Librairies[]    findAll()
 * @method Librairies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibrairiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Librairies::class);
    }

    // /**
    //  * @return Librairies[] Returns an array of Librairies objects
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
    public function findOneBySomeField($value): ?Librairies
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
