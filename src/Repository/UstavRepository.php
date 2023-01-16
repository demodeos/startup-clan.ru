<?php

namespace App\Repository;

use App\Entity\Ustav;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ustav>
 *
 * @method Ustav|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ustav|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ustav[]    findAll()
 * @method Ustav[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UstavRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ustav::class);
    }

    public function save(Ustav $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ustav $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Ustav[] Returns an array of Ustav objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findLast(): ?string
    {
        return $this->createQueryBuilder('u')
            ->select('u.text')
            ->orderBy('u.updatedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
