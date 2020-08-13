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
    class CompanyRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        
        
        /**
         * CompanyRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Company::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        /**
         * @param  int  $user_id
         *
         * @return array
         * @deprecated
         */
        public function findAllCompaniesByUserId(int $user_id):array
        {
            $is_active                        = 1;
            $company_relationship_type_id     = 5200;
            $association_relationship_type_id = 200;
    
            $company_id = $this->selectPrimaryCompanyByUserId($user_id);
            
            $company = $this->createQueryBuilder('company')
                            ->join('company.relationship', 'relationship')
                            ->andWhere(
                                '
                                    relationship.association = :company_id
                                    AND
                                    relationship.isActive = :is_active
                                    AND
                                        (
                                        relationship.relationshipType = :company_relationship_type_id
                                        OR
                                        relationship.relationshipType = :association_relationship_type_id
                                        )
                            '
                            )
                            ->setParameter('company_id', $company_id)
                //                            ->setParameter('user_id', $user_id)
                            ->setParameter('is_active', $is_active)
                            ->setParameter('company_relationship_type_id', $company_relationship_type_id)
                            ->setParameter('association_relationship_type_id', $association_relationship_type_id)
                            ->orderBy('relationship.relationshipType', 'DESC')
                            ->addOrderBy('company.nameFormal', 'ASC')
                            ->getQuery()
                            ->getResult()
            ;
            
            // dd($company);
            
            return $company;
        }
        
        
        
        
        
        
        // /**
        //  * @return Company[] Returns an array of Company objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('c')
                ->andWhere('c.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('c.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        
        /*
        public function findOneBySomeField($value): ?Company
        {
            return $this->createQueryBuilder('c')
                ->andWhere('c.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
        
    }
