<?php
    
    namespace App\Repository;
    
    use App\Entity\Ballot;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method Ballot|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Ballot|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Ballot[]    findAll()
     * @method Ballot[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class BallotRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * BallotRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Ballot::class);
    
            $this->conn = $this->getEntityManager()->getConnection();
    
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        
        // /**
        //  * @return Ballot[] Returns an array of Ballot objects
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
        public function findOneBySomeField($value): ?Ballot
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
