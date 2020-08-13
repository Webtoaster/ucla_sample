<?php
	
	namespace App\Repository;
	
	use App\Entity\Company;
	use App\Entity\Relationship;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\DBAL\DBALException;
	use Psr\Log\LoggerInterface;
	use Symfony\Bridge\Doctrine\RegistryInterface;
	use Symfony\Component\HttpFoundation\RequestStack;
	
	/**
	 * @method Relationship|null find($id, $lockMode = NULL, $lockVersion = NULL)
	 * @method Relationship|null findOneBy(array $criteria, array $orderBy = NULL)
	 * @method Relationship[]    findAll()
	 * @method Relationship[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
	 */
	class RelationshipRepository extends ServiceEntityRepository
	{
		
		
		use RepositoryCommonTraits;
		
		use SQLQueriesTrait;
		
		/**
		 * CompanyRepository constructor.
		 *
		 * @param  RegistryInterface  $registry
		 * @param  RequestStack       $requestStack
		 */
		public function __construct(RegistryInterface $registry, RequestStack $requestStack)
		{
			parent::__construct($registry, Relationship::class);
			
			$this->conn = $this->getEntityManager()->getConnection();
			
			$this->logger = LoggerInterface::class;
			
			$this->requestStack = $requestStack;
			
			$request = $this->requestStack->getCurrentRequest();
			
			$ip = $request->getClientIp();
			
			if(filter_var($ip, FILTER_VALIDATE_IP)){
				$this->clientIp = $ip;
			}
			else {
				$this->clientIp = '';
			}
			
			unset($request);
		}
		
		
		/**
		 * @return int
		 */
		public function addAssociationToCompany(int $association_id, int $company_id):int
		{
			$election_id          = NULL;
			$owner_id             = NULL;
			$permission_id        = NULL;
			$person_id            = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 200;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		/**
		 * @param  int  $election_id
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		public function addElectionToAssociation(int $election_id, int $association_id):int
		{
			$company_id           = NULL;
			$owner_id             = NULL;
			$permission_id        = NULL;
			$person_id            = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 4000;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int  $owner_id
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		public function addOwnerToAssociation(int $owner_id, int $association_id):int
		{
			$company_id           = NULL;
			$election_id          = NULL;
			$permission_id        = NULL;
			$person_id            = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 3100;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		/**
		 * @param  int  $owner_id
		 * @param  int  $election_id
		 *
		 * @return int
		 */
		public function addOwnerToElection(int $owner_id, int $election_id):int
		{
			$association_id       = NULL;
			$company_id           = NULL;
			$permission_id        = NULL;
			$person_id            = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 3200;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int  $proxy_id
		 * @param  int  $owner_id
		 * @param  int  $association_id
		 * @param  int  $election_id
		 *
		 * @return int
		 */
		public function addProxyToOwner(int $proxy_id, int $owner_id, int $association_id, int $election_id):int
		{
			$company_id           = NULL;
			$permission_id        = NULL;
			$person_id            = NULL;
			$relationship_type_id = 3300;
			$supervisor_id        = $owner_id;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		public function addUserToAssociation(int $person_id, int $association_id):int
		{
			$company_id           = NULL;
			$election_id          = NULL;
			$owner_id             = NULL;
			$permission_id        = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 5100;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $company_id
		 *
		 * @return int
		 */
		public function addUserToCompany(int $person_id, int $company_id):int
		{
			$association_id       = NULL;
			$election_id          = NULL;
			$owner_id             = NULL;
			$permission_id        = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 5200;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $company_id
		 *
		 * @return int
		 */
		public function addUserToCompanyAsOwner(int $person_id, int $company_id):int
		{
			$association_id       = NULL;
			$election_id          = NULL;
			$owner_id             = NULL;
			$permission_id        = 1000;
			$proxy_id             = NULL;
			$relationship_type_id = 5200;
			$supervisor_id        = $person_id;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $election_id
		 *
		 * @return int
		 */
		public function addUserToElection(int $person_id, int $election_id):int
		{
			$association_id       = NULL;
			$company_id           = NULL;
			$owner_id             = NULL;
			$permission_id        = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 5000;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int       $person_id
		 * @param  int       $permission_id
		 * @param  int|null  $association_id
		 *
		 * @return int
		 */
		public function addUserToPermission(int $person_id, int $permission_id, int $association_id = NULL):int
		{
			$company_id           = NULL;
			$election_id          = NULL;
			$owner_id             = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 1000;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return int
		 */
		public function addUserToSelf(int $person_id):int
		{
			if($this->selectDoesUserHaveSelfRelationship($person_id) === FALSE){
				return 0;
			}
			
			$association_id       = NULL;
			$company_id           = NULL;
			$election_id          = NULL;
			$owner_id             = NULL;
			$permission_id        = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 100;
			$supervisor_id        = $person_id;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
		/**
		 * @param  int  $election_id
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		public function removeElectionFromAssociation(int $election_id, int $association_id):int
		{
		}
		
		/**
		 * @param  int  $person_id
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		public function removeUserFromAssociation(int $person_id, int $association_id):int
		{
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $company_id
		 *
		 * @return int
		 */
		public function removeUserFromCompany(int $person_id, int $company_id):int
		{
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $election_id
		 *
		 * @return int
		 */
		public function removeUserFromElection(int $person_id, int $election_id):int
		{
		}
		
		//        private function select
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return int
		 */
		public function removeUserFromSelf(int $person_id):int
		{
		}
		
		
		/**
		 * @param  int  $owner_id
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		public function removeOwnerFromAssociation(int $owner_id, int $association_id):int
		{
		}
		
		
		/**
		 * @param  int  $owner_id
		 * @param  int  $election_id
		 *
		 * @return int
		 */
		public function removeOwnerFromElection(int $owner_id, int $election_id):int
		{
		}
		
		
		/**
		 * @deprecated
		 * @return int
		 */
		private function createRelationship():int
		{
			$this->buildSQLArray();
			
			$start   = 'INSERT INTO';
			$start   .= ' relationship(  ';
			$columns = implode(' , ', $this->columns);
			$middle  = '
                ,created_at
                ,updated_at
                ,is_active
                ) VALUES ( ';
			$values  = implode(' , ', $this->values);
			$end     = '
                ,NOW()
                ,NOW()
                ,' . $this->getIsActive() . ')';
			
			$sql = $start . $columns . $middle . $values . $end;
			
			return $this->executeSQLInsertStatement($sql);
		}
		
		
		/**
		 * @param $association_id
		 *
		 * @return array|mixed[]
		 * @throws DBALException
		 */
		public function findAssociationByAssociationId(int $association_id):array
		{
			return $this->selectAssociationByAssociationId($association_id);
		}
		
		
		/**
		 * @param  int  $company_id
		 *
		 * @return array
		 */
		public function findAllAssociationsByCompanyId(int $company_id):array
		{
			return $this->selectAllAssociationsByParentCompanyId($company_id);
		}
		
		
		/**
		 * @param  int  $user_id
		 *
		 * @return array
		 */
		public function findAllAssociationIdsByUserId(int $user_id):array
		{
			$company_id = $this->selectPrimaryCompanyIdByUserId($user_id);
			
			$rs = $this->selectAllAssociationIdsByParentCompanyId($company_id);
			
			$association_ids = [];
			foreach($rs as $r) {
				$association_ids[] = $r['association_id'];
			}
			
			return $association_ids;
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return array
		 * @todo Rework this to look like the method to find everything.
		 */
		public function findAllAssociationsByUserId(int $person_id):array
		{
			$is_active                        = 1;
			$company_relationship_type_id     = 5200;
			$association_relationship_type_id = 200;
			
			$company_id = $this->selectPrimaryCompanyIdByUserId($person_id);
			
			dump($company_id);
			
			$company = $this->createQueryBuilder('relationship')
			                ->leftJoin('relationship.association', 'association')
			                ->andWhere(
				                '(
                                relationship.association = :company_id
                                AND
                                relationship.isActive = :is_active
                                AND
                                    (
                                    relationship.relationshipType = :company_relationship_type_id
                                    OR
                                    relationship.relationshipType = :association_relationship_type_id
                                    )
                                )
                               OR
                                relationship.association = :company_id
                                
                            '
			                )
			                ->setParameter('company_id', $company_id)
				//                            ->setParameter('person_id', $person_id)
				            ->setParameter('is_active', $is_active)
			                ->setParameter('company_relationship_type_id', $company_relationship_type_id)
			                ->setParameter('association_relationship_type_id', $association_relationship_type_id)
			                ->orderBy('relationship.relationshipType', 'DESC')
			                ->addOrderBy('association.nameFormal', 'ASC')
			                ->getQuery()
			                ->getResult()
			;
			
			dump($company);
			
			return $company;
		}
		
		
		/**
		 * @deprecated
		 *
		 * @param  int  $person_id
		 *
		 * @return int
		 * @throws DBALException
		 */
		public function addSelfRelationship(int $person_id):int
		{
			return $this->insertSelfRelationship($person_id);
		}
		
		
		/**
		 *
		 */
		public function updateRelationship():void
		{
		}
		
		
		/**
		 *
		 */
		public function deleteRelationship():void
		{
			$this->buildSQLArray();
		}
		
		/**
		 *
		 */
		public function suspendRelationship():void
		{
			$this->buildSQLArray();
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return int
		 * @throws DBALException
		 */
		public function countRelationshipsOfUser(int $person_id = 0):int
		{
			return $this->selectCountRelationshipsOfUser($person_id);
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $association_id
		 *
		 * @return bool
		 * @throws DBALException
		 */
		public function isUserInAssociation(int $person_id, int $association_id):bool
		{
			$count = $this->selectIsUserInAssociation($person_id, $association_id);
			
			return $count > 0;
		}
		
		/**
		 * @param  int  $person_id
		 * @param  int  $company_id
		 *
		 * @return bool
		 * @throws DBALException
		 */
		public function isUserInCompany(int $person_id, int $company_id):bool
		{
			$count = $this->selectCountUserInCompany($person_id, $company_id);
			
			return $count > 0;
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return bool
		 */
		public function doesUserHaveCompanyRelationship(int $person_id):bool
		{
			return $this->selectDoesUserHaveAUserToCompanyRelationship($person_id);
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return int
		 */
		public function countNumberOfCompaniesToUser(int $person_id):int
		{
			return $this->selectNumberOfCompaniesToUser($person_id);
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $supervisor_id
		 *
		 * @return int
		 * @throws DBALException
		 */
		public function insertNewUserRelationship(int $person_id, $supervisor_id = NULL):?int
		{
			$noOfRelationships = $this->countRelationshipsOfUser($person_id);
			
			if($noOfRelationships < 1 && $supervisor_id === NULL){
				return $this->insertSelfRelationship($person_id);
			}
			
			/**
			 * This means the insert didn't happen.
			 */
			return 0;
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return Company
		 * @todo Rework this to look like the method to find everything.
		 */
		public function findAllCompaniesByUserId(int $person_id):Company
		{
			$is_active                        = 1;
			$company_relationship_type_id     = 5200;
			$association_relationship_type_id = 200;
			
			$company_id = $this->findPrimaryCompanyByUserId($person_id);
			
			dump($company_id);
			
			$company = $this->createQueryBuilder('relationship')
			                ->leftJoin('relationship.association', 'association')
			                ->andWhere(
				                '(
                                relationship.association = :company_id
                                AND
                                relationship.isActive = :is_active
                                AND
                                    (
                                    relationship.relationshipType = :company_relationship_type_id
                                    OR
                                    relationship.relationshipType = :association_relationship_type_id
                                    )
                                )
                               OR
                                relationship.association = :company_id
                                
                            '
			                )
			                ->setParameter('company_id', $company_id)
				//                            ->setParameter('person_id', $person_id)
				            ->setParameter('is_active', $is_active)
			                ->setParameter('company_relationship_type_id', $company_relationship_type_id)
			                ->setParameter('association_relationship_type_id', $association_relationship_type_id)
			                ->orderBy('relationship.relationshipType', 'DESC')
			                ->addOrderBy('association.nameFormal', 'ASC')
			                ->getQuery()
			                ->getResult()
			;
			
			dump($company);
			
			return $company;
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return array
		 */
		public function findPrimaryCompanyAndAllAssociationsByUserId(int $person_id):array
		{
			return $this->selectUnionCompanyAndAllAssociationsByUserId($person_id);
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return int
		 */
		public function findPrimaryCompanyIdByUserId(int $person_id):int
		{
			return $this->selectPrimaryCompanyIdByUserId($person_id);
		}
		
		/**
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		public function findPrimaryCompanyIdByAssociationId(int $association_id):int
		{
			
			
			return $this->selectPrimaryCompanyIdByAssociationId($association_id);
		}
		
		
		
		
		//
		//                                      ARTIFACT CODE FOR RIGHT NOW
		//                                      ARTIFACT CODE FOR RIGHT NOW
		//                                      ARTIFACT CODE FOR RIGHT NOW
		//
		
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
		 * @return int
		 */
		public function addTEMPLATE(int $association_id, int $company_id):int
		{
			$association_id       = NULL;
			$company_id           = NULL;
			$election_id          = NULL;
			$owner_id             = NULL;
			$permission_id        = NULL;
			$person_id            = NULL;
			$proxy_id             = NULL;
			$relationship_type_id = 5100;
			$supervisor_id        = NULL;
			
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$params = compact(
				'association_id',
				'company_id',
				'election_id',
				'owner_id',
				'permission_id',
				'person_id',
				'proxy_id',
				'relationship_type_id',
				'supervisor_id',
				'created_from_ip',
				'updated_from_ip',
				'is_active'
			);
			
			return $this->insertRelationshipMaster($params);
		}
		
		
	}
