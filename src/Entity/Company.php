<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\AddressBillingTrait;
    use App\Entity\Common\AddressMailingTrait;
    use App\Entity\Common\AddressPhysicalTrait;
    use App\Entity\Common\AddressUrlTrait;
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\DisplayBillingAddressTrait;
    use App\Entity\Common\DisplayMailingAddressTrait;
    use App\Entity\Common\DisplayPhysicalAddressTrait;
    use App\Entity\Common\NameFormalTrait;
    use App\Entity\Common\PhoneFaxTrait;
    use App\Entity\Common\PhoneWorkTrait;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;
    use Exception;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    use Symfony\Component\Validator\Constraints as Assert;
    
    /**
     * Company
     *
     * @ORM\Table(
     *     name="company",
     *     indexes={
     *          @ORM\Index(name="fk_idx_company_to_person_id",              columns={"person_id"}),
     *          @ORM\Index(name="idx_company_physical_address_zip_code",    columns={"physical_address_zip_code"}),
     *          @ORM\Index(name="idx_company_name_formal",                  columns={"name_formal"}),
     *          @ORM\Index(name="idx_company_billing_address_zip_code",     columns={"billing_address_zip_code"}),
     *          @ORM\Index(name="idx_company_mailing_address_zip_code",     columns={"mailing_address_zip_code"})
     *      }
     * )
     *
     * @ORM\HasLifecycleCallbacks()
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\CompanyRepository",
     * )
     *
     */
    class Company
    {
    
        /**
         * @var int $companyId
         *
         * @ORM\Column(
         *     name="company_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for company"}
         * )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $companyId;
    
        // /**
        //  * @var Association $association
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="App\Entity\Association",
        //  *     mappedBy="company"
        //  * )
        //  */
        // private $association;
    
        /**
         *
         * This is the entity that Owns this company.
         *
         * @var int $person
         *
         * @ORM\Column(
         *     name="person_id",
         *     type="integer",
         *     nullable=true,
         *     options={"unsigned"=true,"comment"="Pseudo Foreign Key to Person, because this Company is the master to a User"}
         * )
         */
        private $personId;
        
        
        /**
         * Common Fields Implementation through Traits.
         */
    
        use NameFormalTrait;
    
        use AddressPhysicalTrait;
        use DisplayPhysicalAddressTrait;
    
        use AddressMailingTrait;
        use DisplayMailingAddressTrait;
    
        use AddressBillingTrait;
        use DisplayBillingAddressTrait;
    
        use PhoneWorkTrait;
        use PhoneFaxTrait;
    
        use AddressUrlTrait;
    
    
        /**
         * @var int $numberOfSections
         *
         * @Assert\GreaterThanOrEqual(
         *     groups={"new_association"},
         *     value="1",
         *     message="Please Select the Number of Sections within your community.  If Condo, select 1."
         * )
         *
         * @ORM\Column(
         *     name="number_of_sections",
         *     type="integer",
         *     nullable=true,
         *     options={"unsigned"=true,"comment"="Number of sub-sections of the Associations."}
         * )
         */
        private $numberOfSections;
    
        /**
         * @var int $numberOfProperties
         *
         * @Assert\GreaterThan(
         *     groups={"new_association"},
         *     value="10",
         *     message="You must enter a number of Properties within your Association."
         * )
         *
         * @ORM\Column(
         *     name="number_of_properties",
         *     type="integer",
         *     nullable=true,
         *     options={"unsigned"=true,"comment"="Number of properties in this Association"}
         * )
         */
        private $numberOfProperties;
    
        /**
         * @var bool
         *
         * @ORM\Column(
         *     name="is_management_company",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0,"comment"="Is current Record representing a Management Company"}
         *     )
         */
        private $isManagementCompany = FALSE;
        
        /**
         * @var bool
         *
         * @ORM\Column(
         *     name="is_association_company",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0,"comment"="Is current Record representing an HOA"}
         *     )
         */
        private $isAssociationCompany = FALSE;
    
    
        /**
         * @ORM\OneToMany(
         *     targetEntity="App\Entity\Relationship",
         *     mappedBy="company"
         * )
         */
        private $relationship;
        
        /**
         * Company constructor.
         *
         * @throws Exception
         */
        public function __construct()
        {
            $this->relationship = new ArrayCollection();
        }
    
        /**
         * @return int|null
         */
        public function getNumberOfSections():?int
        {
            return $this->numberOfSections;
        }
    
        /**
         * @param  int  $numberOfSections
         *
         * @return Company
         */
        public function setNumberOfSections(int $numberOfSections):Company
        {
            $this->numberOfSections = $numberOfSections;
    
            return $this;
        }
    
        /**
         * @return int|null
         */
        public function getNumberOfProperties():?int
        {
            return $this->numberOfProperties;
        }
    
    
        // @formatter:off
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        // @formatter:on
    
        /**
         * @param  int  $numberOfProperties
         *
         * @return Company
         */
        public function setNumberOfProperties(int $numberOfProperties):Company
        {
            $this->numberOfProperties = $numberOfProperties;
    
            return $this;
        }
    
        /**
         * @return bool
         */
        public function isManagementCompany():bool
        {
            return $this->isManagementCompany;
        }
    
        /**
         * @return bool|null
         */
        public function getIsManagementCompany():?bool
        {
            return $this->isManagementCompany;
        }
    
        /**
         * @param  bool  $isManagementCompany
         *
         * @return Company
         */
        public function setIsManagementCompany(bool $isManagementCompany):Company
        {
            $this->isManagementCompany = $isManagementCompany;
    
            return $this;
        }
    
        /**
         * @return bool
         */
        public function isAssociationCompany():bool
        {
            return $this->isAssociationCompany;
        }
    
        /**
         * @return bool|null
         */
        public function getIsAssociationCompany():?bool
        {
            return $this->isAssociationCompany;
        }
    
        /**
         * @param  bool  $isAssociationCompany
         *
         * @return Company
         */
        public function setIsAssociationCompany(bool $isAssociationCompany):Company
        {
            $this->isAssociationCompany = $isAssociationCompany;
    
            return $this;
        }
    
        /**
         * @return string
         */
        public function __toString()
        {
            return $this->getNameFormal();
        }
    
        /**
         * @return int|null
         */
        public function getCompanyId():?int
        {
            return $this->companyId;
        }
    
    
        /**
         * @param  Relationship  $relationship
         *
         * @return Company
         */
        public function addRelationship(Relationship $relationship):self
        {
            if (!$this->relationship->contains($relationship)) {
                $this->relationship[] = $relationship;
                $relationship->setCompany($this);
            }
        
            return $this;
        }
    
        /**
         * @param  Relationship  $relationship
         *
         * @return Company
         */
        public function removeRelationship(Relationship $relationship):self
        {
            if ($this->relationship->contains($relationship)) {
                $this->relationship->removeElement($relationship);
                // set the owning side to null (unless already changed)
                if ($relationship->getCompany() === $this) {
                    $relationship->setCompany(NULL);
                }
            }
        
            return $this;
        }
    
        /**
         * @return Collection|Relationship[]
         */
        public function getRelationship():Collection
        {
            return $this->relationship;
        }
    
    
        // /**
        //  * @return Collection|Relationship[]
        //  */
        // public function getRelationships():Collection
        // {
        //     return $this->relationship;
        // }
    
        /**
         * @return null|int
         */
        public function getPersonId():?int
        {
            return $this->personId;
        }
    
        /**
         * @param  null|int  $personId
         *
         * @return Company
         */
        public function setPersonId(?int $personId):self
        {
            $this->personId = $personId;
            
            return $this;
        }
    
    
    }
