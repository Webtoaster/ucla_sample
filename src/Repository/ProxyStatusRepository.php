<?php

namespace App\Repository;

use App\Entity\ProxyStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProxyStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProxyStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProxyStatus[]    findAll()
 * @method ProxyStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProxyStatusRepository extends ServiceEntityRepository
{
    
    use RepositoryCommonTraits;
    
    /**
     * ProxyStatusRepository constructor.
     *
     * @param  RegistryInterface  $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProxyStatus::class);
    
        $this->conn = $this->getEntityManager()->getConnection();
    
        $this->logger = LoggerInterface::class;
    
    }
    
    
    
    
    // /**
    //  * @return ProxyStatus[] Returns an array of ProxyStatus objects
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
    public function findOneBySomeField($value): ?ProxyStatus
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
