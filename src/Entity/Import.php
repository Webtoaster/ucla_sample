<?php
	
	namespace App\Entity;
	
	use App\Entity\Common\AddressEmailTrait;
	use App\Entity\Common\AddressMailingTrait;
	use App\Entity\Common\AddressPropertyTrait;
	use App\Entity\Common\LegalDescriptionTrait;
	use App\Entity\Common\NameFormalTrait;
	use App\Entity\Common\NameHumanTrait;
	use App\Entity\Common\PhoneFaxTrait;
	use App\Entity\Common\PhoneHomeTrait;
	use App\Entity\Common\PhoneMobileTrait;
	use App\Entity\Common\PhoneWorkTrait;
	use DateTime;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @package App\Entity\Import
	 * @ORM\Table(
	 *     name="import",
	 *     indexes={
	 *          @ORM\Index(name="idx_import_external_account_id",       columns={"external_account_id"}),
	 *          @ORM\Index(name="idx_import_internal_account_id",       columns={"internal_account_id"}),
	 *          @ORM\Index(name="idx_import_internal_owner_id",         columns={"internal_owner_id"}),
	 *          @ORM\Index(name="idx_import_internal_property_id",      columns={"internal_property_id"}),
	 *          @ORM\Index(name="idx_import_import_date_time",          columns={"created_at"}),
	 *          @ORM\Index(name="idx_import_association_id",            columns={"association_id"}),
	 *          @ORM\Index(name="idx_import_company_id",                columns={"company_id"}),
	 *          @ORM\Index(name="idx_import_import_status_id",          columns={"import_status_id"})
	 *     }
	 * )
	 * @ORM\Entity(
	 *     repositoryClass="App\Repository\ImportRepository",
	 * )
	 */
	class Import
	{
		
		/**
		 * @var int $importId The Primary Key for the Entity.
		 * @ORM\Column(
		 *     name="import_id",
		 *     type="integer",
		 *     nullable=false,
		 *     options={"unsigned"=true,"comment"="Primary Key for Imported Voters"}
		 * )
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		private $importId;
		
		/**
		 * @var int $associationId
		 * @ORM\Column(
		 *     name="association_id",
		 *     type="integer",
		 *     nullable=false,
		 *     options={
		 *          "unsigned"=true,
		 *          "comment"="Foreign Key to Company impersonating Association."
		 *     }
		 * )
		 */
		private $associationId;
		
		/**
		 * @var int|null $companyId
		 * @ORM\Column(
		 *     name="company_id",
		 *     type="integer",
		 *     nullable=true,
		 *     options={
		 *          "unsigned"=true,
		 *          "comment"="Foreign Key to Company not impersonating Association."
		 *     }
		 * )
		 */
		private $companyId;
		
		/**
		 * @ORM\ManyToOne(
		 *     targetEntity="Upload",
		 *     inversedBy="imports"
		 * )
		 * @ORM\JoinColumn(
		 *     nullable=false,
		 *     referencedColumnName="upload_id",
		 *     fieldName="upload_id"
		 * )
		 */
		private $upload;
		
		//  Now starts the imported Data from the Association.
		//  Now starts the imported Data from the Association.
		//  Now starts the imported Data from the Association.
		
		//  Foreign ID's from the Association Accounting System and Appraisal District
		//  Foreign ID's from the Association Accounting System and Appraisal District
		//  Foreign ID's from the Association Accounting System and Appraisal District
		
		/**
		 * @var string|null $externalAccountId
		 * @ORM\Column(
		 *     name="external_account_id",
		 *     type="string",
		 *     length=128,
		 *     nullable=true,
		 *     options={
		 *          "fixed"=true,
		 *          "comment"="External Account ID from an Organization like a County Appraisal District."
		 *      }
		 * )
		 */
		private $externalAccountId;
		
		/**
		 * @var string|null $internalAccountId
		 * @ORM\Column(
		 *     name="internal_account_id",
		 *     type="string",
		 *     length=128,
		 *     nullable=true,
		 *     options={
		 *          "fixed"=true,
		 *          "comment"="Internal Account ID from the Associations Accounting System."
		 *      }
		 * )
		 */
		private $internalAccountId;
		
		/**
		 * @var string|null $internalOwnerId
		 * @ORM\Column(
		 *     name="internal_owner_id",
		 *     type="string",
		 *     length=128,
		 *     nullable=true,
		 *     options={
		 *          "fixed"=true,
		 *          "comment"="Owner ID from the Assosciations Account System.  Useful when an owner owns more than one property."
		 *      }
		 * )
		 */
		private $internalOwnerId;
		
		/**
		 * @var string|null $internalPropertyId
		 * @ORM\Column(
		 *     name="internal_property_id",
		 *     type="string",
		 *     length=128,
		 *     nullable=true,
		 *     options={
		 *          "fixed"=true,
		 *          "comment"="Property ID from the Assosciations Accounting System."
		 *      }
		 * )
		 */
		private $internalPropertyId;
		
		
		/**
		 * @ORM\ManyToOne(
		 *     targetEntity="ImportStatus"
		 * )
		 * @ORM\JoinColumn(
		 *     name="import_status_id",
		 *     referencedColumnName="import_status_id",
		 *     nullable=true,
		 *     onDelete="SET NULL"
		 * )
		 */
		private $importStatus;
		
		
		//  Identifiable Traits for each property
		//  Identifiable Traits for each property
		//  Identifiable Traits for each property
		
		/**
		 * Name Elements via Traits.
		 */
		use NameHumanTrait;
		use NameFormalTrait;
		
		/**
		 * Phone Elements via Traits.
		 */
		use PhoneHomeTrait;
		use PhoneMobileTrait;
		use PhoneWorkTrait;
		use PhoneFaxTrait;
		
		/**
		 * Email Elements via Traits.
		 */
		use AddressEmailTrait;
		
		/**
		 * @var string|null $username
		 * @ORM\Column(
		 *     name="un",
		 *     type="string",
		 *     length=180,
		 *     nullable=true,
		 *     options={"fixed"=true, "comment"="UserName which can be used to log into the application."}
		 * )
		 */
		private $username;
		
		/**
		 * The Password field is Nullable because this table can hold mere contact information based on
		 * its purpose is to carry information about persons.
		 * Be sure to use FORM LEVEL validation for this field with a Form Class implementation of
		 * of validation or via Form Model Assertion or Ultimately a Password Validation Callback.
		 *
		 * @var string|null $password
		 * @ORM\Column(
		 *     name="pw",
		 *     type="string",
		 *     length=255,
		 *     nullable=true,
		 *     options={"fixed"=true, "comment"="Password which can be imported into the system.  This will be plain text and not encrypted."}
		 * )
		 */
		private $password;
		
		
		/**
		 * Address Elements via Traits.
		 */
		
		use AddressMailingTrait;
		use AddressPropertyTrait;
		
		/**
		 * Legal Description Elements via Traits.
		 */
		use LegalDescriptionTrait;
		
		
		/**
		 * @var string|null $importDateTime
		 * @ORM\Column(
		 *     name="ownership_start_date",
		 *     type="string",
		 *     length=36,
		 *     nullable=true,
		 *     options={
		 *          "fixed"="true",
		 *          "comment"="Date and Time when this property was transacted. This should be in the YYYY-MM-DD HH:MM:SS format."
		 *      }
		 * )
		 */
		private $ownershipStartDate;
		
		
		/**
		 * @var DateTime $createdAt
		 * @ORM\Column(
		 *     name="created_at",
		 *     type="datetime",
		 *     options={
		 *          "comment"="Date and Time this record was imported."
		 *     }
		 * )
		 */
		private $createdAt;
		
		
		/**
		 * @return string
		 */
		public function __toString():string
		{
			
			
			return implode(
				' ',
				array_filter(
					[
						trim($this->getPropertyAddressLine1()),
						trim($this->getPropertyAddressLine2()),
						trim($this->getPropertyAddressCity()),
						trim($this->getPropertyAddressState()),
					]
				)
			);
		}
		
		
		/**
		 * @return int|null
		 */
		public function getImportId():?int
		{
			return $this->importId;
		}
		
		
		/**
		 * @return null|string
		 */
		public function getAssociationId():?string
		{
			return $this->associationId;
		}
		
		/**
		 * @param  null|string  $associationId
		 *
		 * @return Import
		 */
		public function setAssociationId(?string $associationId):self
		{
			$this->associationId = $associationId;
			
			return $this;
		}
		
		/**
		 * @return null|string
		 */
		public function getInternalAccountId():?string
		{
			return $this->internalAccountId;
		}
		
		/**
		 * @param  null|string  $internalAccountId
		 *
		 * @return Import
		 */
		public function setInternalAccountId(?string $internalAccountId):self
		{
			$this->internalAccountId = $internalAccountId;
			
			return $this;
		}
		
		/**
		 * @return null|string
		 */
		public function getExternalAccountId():?string
		{
			return $this->externalAccountId;
		}
		
		/**
		 * @param  null|string  $externalAccountId
		 *
		 * @return Import
		 */
		public function setExternalAccountId(?string $externalAccountId):self
		{
			$this->externalAccountId = $externalAccountId;
			
			return $this;
		}
		
		
		/**
		 * @return null|string
		 */
		public function getUsername():?string
		{
			return $this->username;
		}
		
		/**
		 * @param  null|string  $username
		 *
		 * @return Import
		 */
		public function setUsername(?string $username):self
		{
			$this->username = $username;
			
			return $this;
		}
		
		/**
		 * @return null|string
		 */
		public function getPassword():?string
		{
			return $this->password;
		}
		
		/**
		 * @param  null|string  $password
		 *
		 * @return Import
		 */
		public function setPassword(?string $password):self
		{
			$this->password = $password;
			
			return $this;
		}
		
		/**
		 * Sets createdAt.
		 *
		 * @param  DateTime  $createdAt
		 *
		 * @return $this
		 */
		public function setCreatedAt(DateTime $createdAt):self
		{
			$this->createdAt = $createdAt;
			
			return $this;
		}
		
		/**
		 * Returns createdAt.
		 *
		 * @return DateTime
		 */
		public function getCreatedAt():DateTime
		{
			return $this->createdAt;
		}
		
		/**
		 * @return null|int
		 */
		public function getCompanyId():?int
		{
			return $this->companyId;
		}
		
		/**
		 * @param  null|int  $companyId
		 *
		 * @return $this
		 */
		public function setCompanyId(?int $companyId):self
		{
			$this->companyId = $companyId;
			
			return $this;
		}
		
		/**
		 * @return null|string
		 */
		public function getInternalOwnerId():?string
		{
			return $this->internalOwnerId;
		}
		
		/**
		 * @param  null|string  $internalOwnerId
		 *
		 * @return $this
		 */
		public function setInternalOwnerId(?string $internalOwnerId):self
		{
			$this->internalOwnerId = $internalOwnerId;
			
			return $this;
		}
		
		/**
		 * @return null|string
		 */
		public function getInternalPropertyId():?string
		{
			return $this->internalPropertyId;
		}
		
		/**
		 * @param  null|string  $internalPropertyId
		 *
		 * @return $this
		 */
		public function setInternalPropertyId(?string $internalPropertyId):self
		{
			$this->internalPropertyId = $internalPropertyId;
			
			return $this;
		}
		
		/**
		 * @return null|string
		 */
		public function getOwnershipStartDate():?string
		{
			return $this->ownershipStartDate;
		}
		
		/**
		 * @param  string  $ownershipStartDate
		 *
		 * @return $this
		 */
		public function setOwnershipStartDate(string $ownershipStartDate):self
		{
			$this->ownershipStartDate = $ownershipStartDate;
			
			return $this;
		}
		
		/**
		 * @return Upload|null
		 */
		public function getUpload():?Upload
		{
			return $this->upload;
		}
		
		/**
		 * @param  Upload|null  $upload
		 *
		 * @return $this
		 */
		public function setUpload(?Upload $upload):self
		{
			$this->upload = $upload;
			
			return $this;
		}
		
		/**
		 * @return ImportStatus|null
		 */
		public function getImportStatus():?ImportStatus
		{
			return $this->importStatus;
		}
		
		/**
		 * @param  ImportStatus|null  $importStatus
		 *
		 * @return $this
		 */
		public function setImportStatus(?ImportStatus $importStatus):self
		{
			$this->importStatus = $importStatus;
			
			return $this;
		}
		
		
	}
