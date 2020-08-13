<?php
    
    namespace App\Repository;
    
    use App\Entity\ElectionDate;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method ElectionDate|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method ElectionDate|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method ElectionDate[]    findAll()
     * @method ElectionDate[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class ElectionDateRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * ElectionDateRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        /**
         * ElectionDateRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, ElectionDate::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        
        
        
        // /**
        //  * @return ElectionDate[] Returns an array of ElectionDate objects
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
        public function findOneBySomeField($value): ?ElectionDate
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
