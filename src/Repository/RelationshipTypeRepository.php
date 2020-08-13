<?php
    
    namespace App\Repository;
    
    use App\Entity\RelationshipType;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\Common\Persistence\ManagerRegistry;
    use Psr\Log\LoggerInterface;
    
    /**
     * @method RelationshipType|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method RelationshipType|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method RelationshipType[]    findAll()
     * @method RelationshipType[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class RelationshipTypeRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        
        public function __construct(ManagerRegistry $registry)
        {
            parent::__construct($registry, RelationshipType::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        // /**
        //  * @return RelationshipType[] Returns an array of RelationshipType objects
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
        public function findOneBySomeField($value): ?RelationshipType
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
