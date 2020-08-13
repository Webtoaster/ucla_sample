<?php
	
	namespace App\Repository;
	
	use App\Entity\Import;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Psr\Log\LoggerInterface;
	use Symfony\Bridge\Doctrine\RegistryInterface;
	
	/**
	 * @method Import|null find($id, $lockMode = NULL, $lockVersion = NULL)
	 * @method Import|null findOneBy(array $criteria, array $orderBy = NULL)
	 * @method Import[]    findAll()
	 * @method Import[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
	 */
	class ImportRepository extends ServiceEntityRepository
	{
		
		
		use RepositoryCommonTraits;
		
		use SQLQueriesTrait;
		
		private $import_status_id;
		private $company_id;
		private $association_id;
		private $upload_id;
		
		
		/**
		 * @param  RegistryInterface  $registry
		 */
		public function __construct(RegistryInterface $registry)
		{
			parent::__construct($registry, Import::class);
			
			$this->conn = $this->getEntityManager()->getConnection();
			
			$this->logger = LoggerInterface::class;
		}
		
		
		/**
		 * Import the spreadsheet data array into the import table.
		 *
		 * @param  array  $data            The Data from the Spreadsheet.
		 * @param  int    $association_id  Association Id of the import.
		 * @param  int    $company_id      Company ID of the import.
		 * @param  int    $upload_id
		 * @param  float  $version         From the version management system for importing spreadsheet data.
		 *
		 * @return int
		 */
		public function importSpreadsheetData(array $data, int $association_id, int $company_id, int $upload_id, float $version = 1.00):int
		{
			// dump($data);
			
			/**
			 *  Remove the top row which contains the header data
			 */
			unset($data[1]);
			
			$this->import_status_id = 1000;
			$this->association_id   = $association_id;
			$this->company_id       = $company_id;
			$this->upload_id        = $upload_id;
			
			/**
			 * Loop through the array and insert each row.
			 * Use a counter so that you can report the results of the import.
			 */
			$count = 0;
			foreach($data as $row) {
				
				$params = [];
				
				/**
				 * Because in the future, there is going to be upgrades, then we have maps to help with
				 * the changes to the uploaded spreadsheet files.
				 */
				switch($version) {
					case 1.00:
						$params = $this->map_version_1_00($row);
						break;
				}
				
				$this->addImportRow($params);
				unset ($params);
				$count++;
			}
			
			$recordsUpdated = $this->callProcedureConvertEmptyStringToNull();
			
			// dump($recordsUpdated);
			
			return $count;
		}
		
		
		/**
		 * Execute Store Procedure to convert empty string to NULL in the Import table.
		 *
		 * @return int
		 */
		public function convertEmptyStringToNull():int
		{
			return $this->callProcedureConvertEmptyStringToNull();
		}
		
		
		/**
		 * Perform a Translation of the import data from the spreadsheet to the import table.
		 * Methods like this are private and one will have to written for each version of the import template which is published for the end users.
		 *
		 * @param  array  $row
		 *
		 * @return array
		 */
		private function map_version_1_00(array $row):array
		{
			/**
			 * Start with empty array
			 */
			$params                              = [];
			$params['import_status_id']          = $this->import_status_id;
			$params['company_id']                = $this->company_id;
			$params['association_id']            = $this->association_id;
			$params['upload_id']                 = $this->upload_id;
			$params['external_account_id']       = trim($row['A']);
			$params['internal_account_id']       = trim($row['B']);
			$params['internal_owner_id']         = trim($row['C']);
			$params['internal_property_id']      = trim($row['D']);
			$params['name_formal']               = trim($row['E']);
			$params['name_first']                = trim($row['F']);
			$params['name_middle']               = trim($row['G']);
			$params['name_last']                 = trim($row['H']);
			$params['name_suffix']               = trim($row['I']);
			$params['email']                     = trim($row['J']);
			$params['phone_mobile']              = trim($row['K']);
			$params['phone_home']                = trim($row['L']);
			$params['phone_work']                = trim($row['M']);
			$params['phone_fax']                 = trim($row['N']);
			$params['un']                        = trim($row['O']);
			$params['pw']                        = trim($row['P']);
			$params['property_address_line1']    = trim($row['Q']);
			$params['property_address_line2']    = trim($row['R']);
			$params['property_address_city']     = trim($row['S']);
			$params['property_address_state']    = trim($row['T']);
			$params['property_address_zip_code'] = trim($row['U']);
			$params['mailing_address_line1']     = trim($row['V']);
			$params['mailing_address_line2']     = trim($row['W']);
			$params['mailing_address_city']      = trim($row['X']);
			$params['mailing_address_state']     = trim($row['Y']);
			$params['mailing_address_zip_code']  = trim($row['Z']);
			$params['county']                    = trim($row['AA']);
			$params['lot']                       = trim($row['AB']);
			$params['block']                     = trim($row['AC']);
			$params['subdivision']               = trim($row['AD']);
			$params['legal_description']         = trim($row['AE']);
			$params['ownership_start_date']      = trim($row['AF']);
			
			return $params;
		}
		
		
		/**
		 * @param  array  $params
		 *
		 * @return int
		 */
		private function addImportRow(array $params):int
		{
			return $this->insertIntoImport($params);
		}
		
		
		/**
		 * @return int
		 */
		public function getImportStatusId():int
		{
			return $this->import_status_id;
		}
		
		/**
		 * @param  int  $import_status_id
		 *
		 * @return self
		 */
		public function setImportStatusId(int $import_status_id):self
		{
			$this->import_status_id = $import_status_id;
			
			return $this;
		}
		
		/**
		 * @return int
		 */
		public function getCompanyId():int
		{
			return $this->company_id;
		}
		
		/**
		 * @param  int  $company_id
		 *
		 * @return self
		 */
		public function setCompanyId(int $company_id):self
		{
			$this->company_id = $company_id;
			
			return $this;
		}
		
		/**
		 * @return int
		 */
		public function getAssociationId():int
		{
			return $this->association_id;
		}
		
		/**
		 * @param  mixed  $association_id
		 *
		 * @return self
		 */
		public function setAssociationId($association_id):self
		{
			$this->association_id = $association_id;
			
			return $this;
		}
		
		
		
		
		
		
		// /**
		//  * @return Import[] Returns an array of Import objects
		//  */
		/*
		public function findByExampleField($value)
		{
			return $this->createQueryBuilder('i')
				->andWhere('i.exampleField = :val')
				->setParameter('val', $value)
				->orderBy('i.id', 'ASC')
				->setMaxResults(10)
				->getQuery()
				->getResult()
			;
		}
		*/
		
		/*
		public function findOneBySomeField($value): ?Import
		{
			return $this->createQueryBuilder('i')
				->andWhere('i.exampleField = :val')
				->setParameter('val', $value)
				->getQuery()
				->getOneOrNullResult()
			;
		}
		*/
	}
