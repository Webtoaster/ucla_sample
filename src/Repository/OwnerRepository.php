<?php
    
    namespace App\Repository;
    
    use App\Entity\Owner;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method Owner|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Owner|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Owner[]    findAll()
     * @method Owner[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class OwnerRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Owner::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        // /**
        //  * @return Owner[] Returns an array of Owner objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('o')
                ->andWhere('o.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('o.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        
        /*
        public function findOneBySomeField($value): ?Owner
        {
            return $this->createQueryBuilder('o')
                ->andWhere('o.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    }
