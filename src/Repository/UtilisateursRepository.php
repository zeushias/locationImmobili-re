<?php

namespace App\Repository;

use App\Entity\Utilisateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Utilisateurs>
 *
 * @method Utilisateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateurs[]    findAll()
 * @method Utilisateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateurs::class);
    }

    public function add(Utilisateurs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Utilisateurs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Utilisateurs[] Returns an array of Utilisateurs objects
    */
    public function findById($id): ?Utilisateurs
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.id = :val')
            ->setParameter('val', $id)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()

        ;
    }

    public function findByLoginAndPass($login, $pass): ?Utilisateurs
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.login = :login')
            ->andWhere('u.pass = :pass')
            ->andWhere('u.statut = :statut')
            ->setParameter('login', $login)
            ->setParameter('pass', $pass)
            ->setParameter('statut', 'V')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

        public function getAllValide(): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.statut = :statut')
            ->setParameter('statut', 'V')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByLogin($login): ?Utilisateurs
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.login = :login')
            ->andWhere('u.statut = :statut')
            ->setParameter('login', $login)
            ->setParameter('statut', 'V')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
