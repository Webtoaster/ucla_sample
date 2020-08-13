<?php
    
    namespace App\Repository;
    
    use App\Entity\AssociationStaff;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method AssociationStaff|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method AssociationStaff|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method AssociationStaff[]    findAll()
     * @method AssociationStaff[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class AssociationStaffRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * AssociationStaffRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        /**
         * AssociationStaffRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, AssociationStaff::class);
    
            $this->conn = $this->getEntityManager()->getConnection();
    
            $this->logger = LoggerInterface::class;
        }
        
        
        
        // /**
        //  * @return AssociationStaff[] Returns an array of AssociationStaff objects
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
        public function findOneBySomeField($value): ?AssociationStaff
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
