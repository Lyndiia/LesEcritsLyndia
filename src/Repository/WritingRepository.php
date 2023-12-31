<?php

namespace App\Repository;

use App\Entity\Writing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Writing>
 *
 * @method Writing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Writing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Writing[]    findAll()
 * @method Writing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WritingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Writing::class);
    }

//    /**
//     * @return Writing[] Returns an array of Writing objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Writing
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
