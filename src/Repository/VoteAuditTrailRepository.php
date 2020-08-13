<?php
    
    namespace App\Repository;
    
    use App\Entity\VoteAuditTrail;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method VoteAuditTrail|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method VoteAuditTrail|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method VoteAuditTrail[]    findAll()
     * @method VoteAuditTrail[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class VoteAuditTrailRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * VoteAuditTrailRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, VoteAuditTrail::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        // /**
        //  * @return VoteAuditTrail[] Returns an array of VoteAuditTrail objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('v')
                ->andWhere('v.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('v.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        
        /*
        public function findOneBySomeField($value): ?VoteAuditTrail
        {
            return $this->createQueryBuilder('v')
                ->andWhere('v.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    }
