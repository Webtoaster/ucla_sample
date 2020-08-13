<?php
    
    namespace App\Repository;
    
    use App\Entity\Person;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\DBAL\DBALException;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * Class StatisticsRepository to perform statistical lookups.
     *
     * @package App\Repository
     */
    class StatisticsRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        
        /**
         * PersonRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Person::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        /**
         * @param  int  $user_id
         *
         * @return int
         * @deprecated
         */
        public function NumberOfCompaniesToUser(int $user_id):int
        {
            return $this->selectNumberOfCompaniesToUser($user_id);
        }
        
        
        /**
         * @param  int  $company_id
         *
         * @return int
         */
        public function NumberOfAssociationsToManagementCompany(int $company_id):int
        {
            return $this->selectCountAssociationsInCompany($company_id);
        }
        
        
        /**
         * @param  int  $race_id
         *
         * @throws DBALException
         * @return int
         */
        public function NumberOfOptionsInARace(int $race_id):int
        {
            return $this->selectNumberOfOptionsInARace($race_id);
        }
        
        
        /**
         * @param  int  $election_id
         *
         *
         * @throws DBALException
         * @return int
         */
        public function NumberOfRacesInAnElection(int $election_id):int
        {
            return $this->selectNumberOfRacesInAnElection($election_id);
        }
        
        
        /**
         * @param  int  $association_id
         *
         * @throws DBALException
         * @return int
         */
        public function NumberOfPropertiesUploadedToAnAssociation(int $association_id):int
        {
            return $this->selectNumberOfPropertiesUploadedToAnAssociation($association_id);
        }
        
        /**
         * @param  int  $association_id
         *
         * @throws DBALException
         * @return int
         */
        public function NumberOfPropertiesDeclaredInAnAssociation(int $association_id):int
        {
            return $this->selectNumberOfPropertiesDeclaredInAnAssociation($association_id);
        }
        
        /**
         * @param  int  $election_id
         *
         * @throws DBALException
         * @return int
         */
        public function NumberOfBallotsCastInAnElection(int $election_id):int
        {
            return $this->selectNumberOfBallotsCastInAnElection($election_id);
        }
        
        
        /**
         * @param  int  $race_id
         *
         *
         * @throws DBALException
         * @return int
         */
        public function NumberOfVotesCastInARace(int $race_id):int
        {
            return $this->selectNumberOfVotesCastInARace($race_id);
        }
        
        
        /**
         * @param                   $election_id
         *
         * @return null|mixed
         */
        public function TimeRemainingInAnElection(int $election_id)
        {
            $sql = '
            ';
            
            $params = compact('election_id');
            
            $rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
            
            return $rs['count'];
        }
        
        /**
         * @param  int  $election_id
         *
         * @return mixed
         */
        public function LengthOfTimeInAnElection(int $election_id)
        {
            $sql = '
            
            ';
            
            $params = compact('election_id');
            
            $rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
            
            return $rs['count'];
        }
        
        /**
         * @param  int  $election_id
         *
         * @return mixed
         */
        public function HasElectionMetQuorum(int $election_id)
        {
            $sql = '
            ';
            
            $params = compact('election_id');
            
            $rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
            
            return $rs['count'];
        }
        
        
    }
