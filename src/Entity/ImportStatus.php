<?php
	
	namespace App\Entity;
	
	use App\Entity\Common\BooleanIsActiveTrait;
	use App\Entity\Common\DescriptionShortTrait;
	use App\Entity\Common\SortOrderTrait;
	use Doctrine\ORM\Mapping as ORM;
	use Exception;
	
	/**
	 * @package App\Entity
	 * Class ImportStatus
	 * @ORM\Table(
	 *     name="import_status",
	 * )
	 * @ORM\Entity(
	 *     repositoryClass="App\Repository\ImportStatusRepository",
	 * )
	 */
	class ImportStatus
	{
		
		/**
		 * @var int $importId The Primary Key for the Entity.
		 * @ORM\Column(
		 *     name="import_status_id",
		 *     type="integer",
		 *     nullable=false,
		 *     options={"unsigned"=true,"comment"="Primary Key for Import Status Voters"}
		 * )
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		private $importStatusId;
		
		
		use DescriptionShortTrait;
		use SortOrderTrait;
		use BooleanIsActiveTrait;
		
		
		/**
		 * Import Status constructor.
		 *
		 * @throws Exception
		 */
		public function __construct()
		{
		}
		
		
		/**
		 * @return string
		 */
		public function __toString():string
		{
			return $this->getDescriptionShort();
		}
		
		
		/**
		 * @return int
		 */
		public function getImportStatusId():int
		{
			return $this->importStatusId;
		}
		
		/**
		 * @param  int  $importStatusId
		 *
		 * @return self
		 */
		public function setImportStatusId(int $importStatusId):self
		{
			$this->importStatusId = $importStatusId;
			
			return $this;
		}
		
		
	}
