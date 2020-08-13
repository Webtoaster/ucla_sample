<?php
    
    namespace App\Repository;
    
    use App\Entity\Company;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method Company|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Company|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Company[]    findAll()
     * @method Company[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class AssociationRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        
        /**
         * AssociationRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Company::class);
    
            $this->conn = $this->getEntityManager()->getConnection();
    
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        // /**
        //  * @return Association[] Returns an array of Association objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('a')
                ->andWhere('a.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('a.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        
        /*
        public function findOneBySomeField($value): ?Association
        {
            return $this->createQueryBuilder('a')
                ->andWhere('a.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    }
