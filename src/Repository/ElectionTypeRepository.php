<?php
    
    namespace App\Repository;
    
    use App\Entity\ElectionType;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method ElectionType|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method ElectionType|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method ElectionType[]    findAll()
     * @method ElectionType[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class ElectionTypeRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        
        /**
         * ElectionTypeRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, ElectionType::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        // /**
        //  * @return ElectionType[] Returns an array of ElectionType objects
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
        public function findOneBySomeField($value): ?ElectionType
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
