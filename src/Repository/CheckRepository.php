<?php
    
    namespace App\Repository;
    
    use App\Entity\Relationship;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\DBAL\DBALException;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * Class CheckRepository to perform Security Lookups.
     *
     * @package App\Repository
     */
    class CheckRepository extends ServiceEntityRepository
    {
    
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        
        /**
         * RelationshipRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Relationship::class);
    
            $this->conn = $this->getEntityManager()->getConnection();
    
            $this->logger = LoggerInterface::class;
        }
        
        
        /**
         * @return bool
         */
        public function canUserCreateAssociation(int $user_id):bool
        {
            return TRUE;
        }
        
        /**
         * @return bool
         */
        public function canUserManageAssociation(int $user_id, int $association_id):bool
        {
            return TRUE;
        }
        
        /**
         * @return bool
         */
        public function canUserManageUser(int $user_id):bool
        {
            return TRUE;
        }
        
        /**
         * @return bool
         */
        public function canUserCreateSubUser(int $user_id):bool
        {
            return TRUE;
        }
        
        /**
         * @return bool
         */
        public function canUserCreateElection(int $user_id):bool
        {
            return TRUE;
        }
        
        /**
         * @return bool
         */
        public function canUserManageElection(int $user_id):bool
        {
            return TRUE;
        }
        
        /**
         * @return bool
         */
        public function canUserManageMembers(int $user_id):bool
        {
            return TRUE;
        }
        
        /**
         * @return bool
         */
        public function canUserViewElectionProgress(int $user_id):bool
        {
            return TRUE;
        }
        
        /**
         * @return bool
         */
        public function canUserViewElectionResults(int $user_id):bool
        {
            return TRUE;
        }
    
    
        /**
         * @param  int  $user_id
         *
         * @return bool
         */
        public function canUserVoteInElection(int $user_id):bool
        {
            return TRUE;
        }
    
    
    
    
    
    
    
    
        /*      TEMPLATE
        public function canUserVoteInElection():bool
        {
        }
        */
        
        // /**
        //  * @return Relationships[] Returns an array of Relationships objects
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
        public function findOneBySomeField($value): ?Relationships
        {
            return $this->createQueryBuilder('r')
                ->andWhere('r.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    
        /**
         * @param  int  $supervisor_id
         *
         * @throws DBALException
         * @return bool
         * @deprecated
         */
        public function canUserAddUser(int $supervisor_id):bool
        {
            $sql = '
                SELECT COUNT(relationship_id) AS `count`
                FROM relationship
                WHERE
                    person_id       = :person_id AND
                    company_id      > 0 AND
                    is_active       > 0 AND
                    permission_id   < 1011
            ';
        
            $rs = $this->executeSQLQueryAndSingleRowResults($sql, ['person_id' => $supervisor_id]);
        
            if ($rs['count'] > 0) {
                return TRUE;
            }
        
            return FALSE;
        }
        
        
    }
