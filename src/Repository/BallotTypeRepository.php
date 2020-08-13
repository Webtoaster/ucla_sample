<?php
    
    namespace App\Repository;
    
    use App\Entity\BallotType;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method BallotType|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method BallotType|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method BallotType[]    findAll()
     * @method BallotType[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class BallotTypeRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * BallotTypeRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        /**
         * BallotTypeRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, BallotType::class);
    
            $this->conn = $this->getEntityManager()->getConnection();
    
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        
        
        
        
        // /**
        //  * @return BallotType[] Returns an array of BallotType objects
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
        public function findOneBySomeField($value): ?BallotType
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
