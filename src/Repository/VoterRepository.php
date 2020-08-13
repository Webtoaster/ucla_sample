<?php
    
    namespace App\Repository;
    
    use App\Entity\Voter;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method Voter|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Voter|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Voter[]    findAll()
     * @method Voter[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class VoterRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        
        
        /**
         * VoterRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Voter::class);
    
            $this->conn = $this->getEntityManager()->getConnection();
    
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        // /**
        //  * @return Voter[] Returns an array of Voter objects
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
        public function findOneBySomeField($value): ?Voter
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
