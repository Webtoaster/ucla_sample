<?php
    
    namespace App\Repository;
    
    use App\Entity\Race;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method Race|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Race|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Race[]    findAll()
     * @method Race[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class RaceRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        /**
         * RaceRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Race::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        // /**
        //  * @return Race[] Returns an array of Race objects
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
        public function findOneBySomeField($value): ?Race
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
