<?php
	
	namespace App\Repository;
	
	use Symfony\Component\HttpFoundation\RequestStack;
	
	/**
	 * Trait SQLExecuteMethodsTrait
	 *
	 * @package App\Repository
	 */
	trait RepositoryCommonTraits
	{
		
		
		/**
		 * @var RequestStack
		 */
		protected $requestStack;
		
		/**
		 * @var null|string
		 */
		private $clientIp;
		
		private $conn;
		
		private $logger;
		
		private $association_id = NULL;
		
		private $company_id = NULL;
		
		private $owner_id = NULL;
		
		private $permission_id = NULL;
		
		private $person_id = NULL;
		
		private $property_id = NULL;
		
		private $proxy_id = NULL;
		
		private $relationship_id = NULL;
		
		private $relationship_type_id = NULL;
		
		private $supervisor_id = NULL;
		
		private $isActive = 1;
		
		private $columns = [];
		
		private $values = [];
		
		
		//                                      EXECUTE SQL METHODS
		//                                      EXECUTE SQL METHODS
		//                                      EXECUTE SQL METHODS
		//                                      EXECUTE SQL METHODS
		//                                      EXECUTE SQL METHODS
		
		/**
		 * Executes a SQL Query without any params returning a result set like a SQL Client.
		 * Warning, Use this for Development only.
		 *
		 * @param  string  $sql
		 *
		 * @return array
		 */
		private function executeRawSQLQuery(string $sql):array
		{
			// dump($sql);
			// dump($params);
			
			$stmt = $this->conn->prepare($sql);
			
			$stmt->execute();
			
			return $stmt->fetchAll();
		}
		
		
		/**
		 * Executes a SQL Command without Parameters such as a Stored Procedure.
		 *
		 * @param  string  $sql
		 *
		 * @return int
		 */
		private function executeSQLCommand(string $sql):int
		{
			// dump($sql);
			// dump($params);
			
			$stmt = $this->conn->prepare($sql);
			
			$stmt->execute();
			
			return $stmt->rowCount();
		}
		
		
		/**
		 * Executes a SQL Command and return the last insert ID
		 *
		 * @param  string  $sql
		 * @param  array   $params
		 *
		 * @return int
		 */
		private function executeSQLInsertStatement(string $sql, array $params = []):int
		{
			// dump($sql);
			// dump($params);
			
			$stmt = $this->conn->prepare($sql);
			if(empty($params)){
				$stmt->execute();
			}
			else {
				$stmt->execute($params);
			}
			
			return $this->conn->lastInsertId();
		}
		
		/**
		 * Executes a SQL Update and return the number of rows affected.
		 *
		 * @param  string  $sql
		 * @param  array   $params
		 *
		 * @return int
		 */
		private function executeSQLUpdateStatement(string $sql, array $params = []):int
		{
			// dump($sql);
			// dump($params);
			
			$stmt = $this->conn->prepare($sql);
			if(empty($params)){
				$stmt->execute();
			}
			else {
				$stmt->execute($params);
			}
			
			return $stmt->rowCount();
		}
		
		
		/**
		 * Query for a multi-row record set of data into an associative array.
		 *
		 * @param  string  $sql
		 * @param  array   $params
		 *
		 * @return array
		 */
		private function executeSQLQueryAndResults(string $sql, array $params = []):array
		{
			// dump($sql);
			// dump($params);
			
			$stmt = $this->conn->prepare($sql);
			if(empty($params)){
				$stmt->execute();
			}
			else {
				$stmt->execute($params);
			}
			
			return $stmt->fetchAll();
		}
		
		/**
		 * Query and return a single row of data into an associative
		 * array.
		 *
		 * @param  string  $sql
		 * @param  array   $params
		 *
		 * @return array
		 */
		private function executeSQLQueryAndSingleRowResults(string $sql, array $params = []):?array
		{
			// dump($sql);
			// dump($params);
			
			$stmt = $this->conn->prepare($sql);
			if(empty($params)){
				$stmt->execute();
			}
			else {
				$stmt->execute($params);
			}
			
			return $stmt->fetch();
		}
		
		
		/**
		 * Query and return just a single value from a single row record
		 * set.  i.e. Count number of records by pulling $rs[0] from
		 * the record set.
		 *
		 * @param  string  $sql
		 * @param  array   $params
		 *
		 * @return mixed[]
		 */
		private function executeSQLQueryAndReturnSingleValueResult(string $sql, array $params = [])
		{
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			//  dump($rs[0]);
			
			return $rs[0];
		}
		
		
		/**
		 * Executes a SQL Delete command and return the number of rows affected.
		 *
		 * @param  string  $sql
		 * @param  array   $params
		 *
		 * @return int
		 */
		private function executeSQLDelete(string $sql, array $params = []):int
		{
			// dump($sql);
			// dump($params);
			
			$stmt = $this->conn->prepare($sql);
			if(empty($params)){
				$stmt->execute();
			}
			else {
				$stmt->execute($params);
			}
			
			return $stmt->rowCount();
		}
		
		
		/**
		 * @return void
		 */
		private function buildSQLArray():void
		{
			$this->columns[] = ' person_id ';
			if($this->getPersonId() > 0){
				$value = $this->getPersonId();
			}
			else {
				$value = ' NULL ';
			}
			$this->values[] = $value;
			
			$this->columns[] = ' supervisor_id ';
			if($this->getSupervisorId() > 0){
				$value = $this->getSupervisorId();
			}
			else {
				$value = ' NULL ';
			}
			$this->values[] = $value;
			
			$this->columns[] = ' company_id ';
			if($this->getCompanyId() > 0){
				$value = $this->getCompanyId();
			}
			else {
				$value = ' NULL ';
			}
			$this->values[] = $value;
			
			$this->columns[] = ' association_id ';
			if($this->getAssociationId() > 0){
				$value = $this->getAssociationId();
			}
			else {
				$value = ' NULL ';
			}
			$this->values[] = $value;
			
			$this->columns[] = ' permission_id ';
			if($this->getPermissionId() > 0){
				$value = $this->getPermissionId();
			}
			else {
				$value = ' NULL ';
			}
			$this->values[] = $value;
			
			$this->columns[] = ' relationship_type_id ';
			if($this->getRelationshipTypeId() > 0){
				$value = $this->getRelationshipTypeId();
			}
			else {
				$value = ' NULL ';
			}
			$this->values[] = $value;
		}
		
		
		
		
		
		
		
		//                                      GETTERS AND SETTERS
		//                                      GETTERS AND SETTERS
		//                                      GETTERS AND SETTERS
		//                                      GETTERS AND SETTERS
		//                                      GETTERS AND SETTERS
		//                                      GETTERS AND SETTERS
		//                                      GETTERS AND SETTERS
		
		/**
		 * @return null
		 */
		public function getRelationshipId()
		{
			return $this->relationship_id;
		}
		
		/**
		 * @param  int  $relationship_id
		 *
		 * @return RelationshipRepository
		 */
		public function setRelationshipId(int $relationship_id):self
		{
			$this->relationship_id = $relationship_id;
			
			return $this;
		}
		
		/**
		 * @return null
		 */
		public function getPersonId()
		{
			return $this->person_id;
		}
		
		/**
		 * @param  int  $person_id
		 *
		 * @return RelationshipRepository
		 */
		public function setPersonId(int $person_id):self
		{
			$this->person_id = $person_id;
			
			return $this;
		}
		
		/**
		 * @return int
		 */
		public function getSupervisorId():int
		{
			return $this->supervisor_id;
		}
		
		/**
		 * @param  int  $supervisor_id
		 *
		 * @return RelationshipRepository
		 */
		public function setSupervisorId(int $supervisor_id):self
		{
			$this->supervisor_id = $supervisor_id;
			
			return $this;
		}
		
		/**
		 * @return null
		 */
		public function getCompanyId()
		{
			return $this->company_id;
		}
		
		/**
		 * @param  int  $company_id
		 *
		 * @return RelationshipRepository
		 */
		public function setCompanyId(int $company_id):self
		{
			$this->company_id = $company_id;
			
			return $this;
		}
		
		/**
		 * @return null
		 */
		public function getAssociationId()
		{
			return $this->association_id;
		}
		
		/**
		 * @param  int  $association_id
		 *
		 * @return RelationshipRepository
		 */
		public function setAssociationId(int $association_id):self
		{
			$this->association_id = $association_id;
			
			return $this;
		}
		
		/**
		 * @return null
		 */
		public function getPermissionId()
		{
			return $this->permission_id;
		}
		
		/**
		 * @param  int  $permission_id
		 *
		 * @return RelationshipRepository
		 */
		public function setPermissionId(int $permission_id):self
		{
			$this->permission_id = $permission_id;
			
			return $this;
		}
		
		/**
		 * @return null
		 */
		public function getRelationshipTypeId()
		{
			return $this->relationship_type_id;
		}
		
		/**
		 * @param  int  $relationship_type_id
		 *
		 * @return RelationshipRepository
		 */
		public function setRelationshipTypeId(int $relationship_type_id):self
		{
			$this->relationship_type_id = $relationship_type_id;
			
			return $this;
		}
		
		/**
		 * @return int
		 */
		public function getIsActive():int
		{
			return $this->isActive;
		}
		
		/**
		 * @param  int  $isActive
		 *
		 * @return RelationshipRepository
		 */
		public function setIsActive(int $isActive):self
		{
			$this->isActive = $isActive;
			
			return $this;
		}
		
		
	}
