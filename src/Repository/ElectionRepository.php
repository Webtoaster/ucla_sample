<?php
    
    namespace App\Repository;
    
    use App\Entity\Election;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method Election|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Election|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Election[]    findAll()
     * @method Election[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class ElectionRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * CompanyRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Election::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        
        
        
        
        
        
        // /**
        //  * @return Election[] Returns an array of Election objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('e')
                ->andWhere('e.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('e.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        
        /*
        public function findOneBySomeField($value): ?Election
        {
            return $this->createQueryBuilder('e')
                ->andWhere('e.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    }
