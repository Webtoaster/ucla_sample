<?php
    
    namespace App\Repository;
    
    use App\Entity\Vote;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method Vote|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Vote|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Vote[]    findAll()
     * @method Vote[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class VoteRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        
        /**
         * VoteRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Vote::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        // /**
        //  * @return Vote[] Returns an array of Vote objects
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
        public function findOneBySomeField($value): ?Vote
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
