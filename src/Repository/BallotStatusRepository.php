<?php

namespace App\Repository;

use App\Entity\BallotStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BallotStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method BallotStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method BallotStatus[]    findAll()
 * @method BallotStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BallotStatusRepository extends ServiceEntityRepository
{
    
    use RepositoryCommonTraits;
    
    /**
     * BallotStatusRepository constructor.
     *
     * @param  RegistryInterface  $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BallotStatus::class);
    
        $this->conn = $this->getEntityManager()->getConnection();
    
        $this->logger = LoggerInterface::class;
    
    }
    
    // /**
    //  * @return BallotStatus[] Returns an array of BallotStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BallotStatus
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
