<?php
    
    namespace App\Repository;
    
    use App\Entity\DisplayMethod;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method DisplayMethod|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method DisplayMethod|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method DisplayMethod[]    findAll()
     * @method DisplayMethod[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class DisplayMethodRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * DisplayMethodRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, DisplayMethod::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        // /**
        //  * @return DisplayMethod[] Returns an array of DisplayMethod objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('d')
                ->andWhere('d.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('d.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        
        /*
        public function findOneBySomeField($value): ?DisplayMethod
        {
            return $this->createQueryBuilder('d')
                ->andWhere('d.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    }
