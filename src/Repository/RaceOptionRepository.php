<?php
    
    namespace App\Repository;
    
    use App\Entity\RaceOption;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method RaceOption|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method RaceOption|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method RaceOption[]    findAll()
     * @method RaceOption[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class RaceOptionRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * RaceOptionRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, RaceOption::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        // /**
        //  * @return RaceOption[] Returns an array of RaceOption objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('r')
                ->andWhere('r.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('r.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        
        /*
        public function findOneBySomeField($value): ?RaceOption
        {
            return $this->createQueryBuilder('r')
                ->andWhere('r.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    }
