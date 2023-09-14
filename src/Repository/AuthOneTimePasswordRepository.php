<?php

namespace App\Repository;

use App\Entity\Auth\AuthOneTimePassword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AuthOneTimePassword>
 *
 * @method AuthOneTimePassword|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthOneTimePassword|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthOneTimePassword[]    findAll()
 * @method AuthOneTimePassword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthOneTimePasswordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthOneTimePassword::class);
    }

//    /**
//     * @return AuthOneTimePassword[] Returns an array of AuthOneTimePassword objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AuthOneTimePassword
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
