<?php

namespace App\Repository;

use App\Entity\TypeLogement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeLogement>
 *
 * @method TypeLogement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeLogement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeLogement[]    findAll()
 * @method TypeLogement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeLogementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeLogement::class);
    }

    public function add(TypeLogement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeLogement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return TypeLogement[] Returns an array of TypeLogement objects
     */
    public function findById($id): ?TypeLogement
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            //->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?TypeLogement
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
