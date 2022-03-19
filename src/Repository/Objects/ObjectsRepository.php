<?php

namespace App\Repository\Objects;

use App\Entity\Objects\Objects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Objects|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objects|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objects[]    findAll()
 * @method Objects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objects::class);
    }

    /*Count Request*/
    public function countObjects() {
        return $this->createQueryBuilder('o')
            ->select('count(o.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function countIsExposedTemp() {
        return $this->createQueryBuilder('o')
            ->where('o.isExposedTemp = 1')
            ->select('count(o.isExposedTemp)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function countIsExposedPerm() {
        return $this->createQueryBuilder('o')
            ->where('o.isExposedPerm = 1')
            ->select('count(o.isExposedPerm)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /*Find Request*/
    public function findLatest() {
        return $this->createQueryBuilder('o')
            ->join('o.tags', 't')
            ->select('o, t')
            ->getQuery();
    }

    public function findByTag($name)
    {
        return $this->createQueryBuilder('o')
            ->join('o.tags', 't')
            ->select('o')
            ->join('o.tags', 'tmp')
            ->where('tmp.name = :name')
            ->addSelect('t')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult();
    }


}
