<?php

namespace App\Repository;

use App\Entity\AssociationStaffPermission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AssociationStaffPermission|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationStaffPermission|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationStaffPermission[]    findAll()
 * @method AssociationStaffPermission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationStaffPermissionRepository extends ServiceEntityRepository
{
    
    use RepositoryCommonTraits;
    
    /**
     * AssociationStaffPermissionRepository constructor.
     *
     * @param  RegistryInterface  $registry
     */
    /**
     * AssociationStaffPermissionRepository constructor.
     *
     * @param  RegistryInterface  $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AssociationStaffPermission::class);
    
        $this->conn = $this->getEntityManager()->getConnection();
    
        $this->logger = LoggerInterface::class;
    
    }
    
    
    // /**
    //  * @return AssociationStaffPermission[] Returns an array of AssociationStaffPermission objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssociationStaffPermission
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
