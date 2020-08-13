<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\AddressEmailUniqueTrait;
    use App\Entity\Common\AddressMailingTrait;
    use App\Entity\Common\AddressPhysicalTrait;
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\CredentialsTrait;
    use App\Entity\Common\NameFormalTrait;
    use App\Entity\Common\NameHumanTrait;
    use App\Entity\Common\PasswordTrait;
    use App\Entity\Common\PhoneFaxTrait;
    use App\Entity\Common\PhoneHomeTrait;
    use App\Entity\Common\PhoneMobileTrait;
    use App\Entity\Common\PhoneWorkTrait;
    use App\Entity\Common\RolesTrait;
    use App\Entity\Common\UsernameUniqueTrait;
    use DateTime;
    use DateTimeInterface;
    use Doctrine\ORM\Mapping as ORM;
    use Exception;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
    use Symfony\Component\Security\Core\User\UserInterface;
    
    /**
     * @package App\Entity
     *
     * Class Person
     *
     * @ORM\Table(
     *     name="person",
     *     indexes={
     *        @ORM\Index(name="fk_idx_person_to_person_type", columns={"person_type_id"}),
     *        @ORM\Index(name="idx_person_name_first", columns={"name_first"}),
     *        @ORM\Index(name="idx_person_verification_key", columns={"verification_key"}),
     *        @ORM\Index(name="idx_person_phone_work", columns={"phone_work"}),
     *        @ORM\Index(name="idx_person_name_last", columns={"name_last"}),
     *        @ORM\Index(name="idx_person_created_at", columns={"created_at"}),
     *        @ORM\Index(name="idx_person_phone_home", columns={"phone_home"}),
     *        @ORM\Index(name="idx_person_password_recovery_key", columns={"password_recovery_key"}),
     *        @ORM\Index(name="idx_person_phone_mobile", columns={"phone_mobile"}),
     *        @ORM\Index(name="idx_person_email", columns={"email"})
     *     }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\PersonRepository",
     * )
     *
     * @UniqueEntity(fields={"email"}, message="There is already an account with this Email Address.")
     */
    class Person implements UserInterface
    {
    
        use RolesTrait;
        use CredentialsTrait;
	
	    // public function checkAuth():void
	    // {
	    //     $this->appendRoles();
	    // }
        
        
        /**
         * @var int $id
         *
         * @ORM\Column(
         *     name="id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for person"}
         * )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;
    
        // /**
        //  * checked
        //  *
        //  * @var Company $company
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="Company",
        //  *     mappedBy="person"
        //  * )
        //  */
        // private $company;
    
        // /**
        //  * checked
        //  *
        //  * @var AssociationStaff $associationStaff
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="App\Entity\AssociationStaff",
        //  *     mappedBy="person"
        //  * )
        //  *
        //  */
        // private $associationStaff;
    
        /**
         * @var PersonType $personType
         *
         * @ORM\ManyToOne(
         *     targetEntity="PersonType"
         * )
         *
         * @ORM\JoinColumn(
         *     name="person_type_id",
         *     referencedColumnName="person_type_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $personType;
    
    
        /**
         * Common Fields Implementation through Traits.
         */
        use NameFormalTrait;
        use NameHumanTrait;
    
        use AddressMailingTrait;
        use AddressPhysicalTrait;
    
        use AddressEmailUniqueTrait;
        use UsernameUniqueTrait;
        use PasswordTrait;
        
        use PhoneHomeTrait;
        use PhoneWorkTrait;
        use PhoneMobileTrait;
        use PhoneFaxTrait;
        
        
        /**
         * @var string|null $verificationKey
         *
         * @ORM\Column(
         *     name="verification_key",
         *     type="string",
         *     length=32,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Key to be included in the verification email"}
         * )
         */
        private $verificationKey;
    
        /**
         * @var DateTime|null $verificationDate
         *
         * @ORM\Column(
         *     name="verification_date",
         *     type="datetime",
         *     nullable=true,
         *     options={"comment"="Date and time verification of email address was performed."}
         * )
         */
        private $verificationDate;
    
        /**
         * @var string|null $verificationIpAddress
         *
         * @ORM\Column(
         *     name="verification_ip_address",
         *     type="string",
         *     length=39,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="IP Address where the verification was made from."}
         * )
         */
        private $verificationIpAddress;
    
        /**
         * @var bool $hasStartedRegistration
         *
         * @ORM\Column(
         *     name="has_started_registration",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Has this person started registration"}
         * )
         */
        private $hasStartedRegistration = FALSE;
        
        /**
         * @var bool $isVerified
         *
         * @ORM\Column(
         *     name="is_verified",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="is email address verified"}
         * )
         */
        private $isVerified = FALSE;
        
        /**
         * @var bool $isRegistered
         *
         * @ORM\Column(
         *     name="is_registered",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="is record registered"}
         * )
         */
        private $isRegistered = FALSE;
        
        /**
         * @var DateTime|null $agreedToTermsAt
         *
         * @ORM\Column(
         *     name="agreed_to_terms_at",
         *     type="datetime",
         *     nullable=true,
         *     options={"comment"="ts when tos was agreed to"}
         * )
         */
        private $agreedToTermsAt;
    
        /**
         * @var int $termsId
         *
         * @ORM\Column(
         *     name="terms_id",
         *     type="integer",
         *     nullable=true,
         *     options={"unsigned"=true,"comment"="Future Forein Key field to more complex legal framework."}
         * )
         */
        private $termsId = 1;
    
    
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
    
        /**
         * Person constructor.
         * Herein, use this for managing the created_at and updated_at fields in the table.
         *
         * @throws Exception
         */
        public function __construct()
        {
            /**
             * Concatenate and Insert the names submitted if the display_name is not assigned.
             */
            if ($this->nameFormal === NULL) {
                $this->setNameFormal(
                    implode(
                        ' ',
                        array_filter(
                            [
                                trim($this->nameFirst),
                                trim($this->nameMiddle),
                                trim($this->nameLast),
                                trim($this->nameSuffix),
                            ]
                        )
                    )
                );
            }
    
            if ($this->getUsername() === NULL) {
                $this->setUn($this->getEmail());
            }
        }
    
    
        /**
         * @return string
         */
        public function __toString()
        {
            return $this->getNameFormal();
        }
    
        /**
         * @return int
         */
        public function getId():int
        {
            return $this->id;
        }
    
    
        /**
         * @return DateTime|null
         */
        public function getAgreedToTermsAt():?DateTime
        {
            return $this->agreedToTermsAt;
        }
    
        /**
         * @param  DateTime|null  $agreedToTermsAt
         *
         * @return Person
         */
        public function setAgreedToTermsAt(?DateTime $agreedToTermsAt):self
        {
            $this->agreedToTermsAt = $agreedToTermsAt;
    
            return $this;
        }
    
        /**
         * @return int|null
         */
        public function getTermsId():?int
        {
            return $this->termsId;
        }
    
        /**
         * @param  int  $termsId
         *
         * @return Person
         */
        public function setTermsId(int $termsId):self
        {
            $this->termsId = $termsId;
    
            return $this;
        }
    
    
        /**
         * A visual identifier that represents this user.
         *
         * Remember, this has to be different than in the Owners authentication method.  Owners uses a strict UN
         * while Person uses a strict email method.
         *
         * @see UserInterface
         */
        public function getUsername():?string
        {
            return (string)$this->getEmail();
        }
    
    
        /**
         * @return string|null
         */
        public function getVerificationKey():?string
        {
            return $this->verificationKey;
        }
    
        /**
         * @param  string|null  $verificationKey
         *
         * @return Person
         */
        public function setVerificationKey(?string $verificationKey):self
        {
            $this->verificationKey = $verificationKey;
    
            return $this;
        }
    
        /**
         * @return DateTimeInterface|null
         */
        public function getVerificationDate():?DateTimeInterface
        {
            return $this->verificationDate;
        }
    
        /**
         * @param  DateTimeInterface|null  $verificationDate
         *
         * @return Person
         */
        public function setVerificationDate(?DateTimeInterface $verificationDate):self
        {
            $this->verificationDate = $verificationDate;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getVerificationIpAddress():?string
        {
            return $this->verificationIpAddress;
        }
    
        /**
         * @param  string|null  $verificationIpAddress
         *
         * @return Person
         */
        public function setVerificationIpAddress(?string $verificationIpAddress):self
        {
            $this->verificationIpAddress = $verificationIpAddress;
    
            return $this;
        }
    
    
        /**
         * @return bool|null
         */
        public function getIsVerified():?bool
        {
            return $this->isVerified;
        }
    
        /**
         * @param  bool  $isVerified
         *
         * @return Person
         */
        public function setIsVerified(bool $isVerified):self
        {
            $this->isVerified = $isVerified;
    
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getIsRegistered():?bool
        {
            return $this->isRegistered;
        }
    
        /**
         * @param  bool  $isRegistered
         *
         * @return Person
         */
        public function setIsRegistered(bool $isRegistered):self
        {
            $this->isRegistered = $isRegistered;
    
            return $this;
        }
    
    
        /**
         * @return bool|null
         */
        public function getHasStartedRegistration():?bool
        {
            return $this->hasStartedRegistration;
        }
    
        /**
         * @param  bool  $hasStartedRegistration
         *
         * @return Person
         */
        public function setHasStartedRegistration(bool $hasStartedRegistration):self
        {
            $this->hasStartedRegistration = $hasStartedRegistration;
    
            return $this;
        }
    
        /**
         * @return null|PersonType
         */
        public function getPersonType():?PersonType
        {
            return $this->personType;
        }
    
        /**
         * @param  null|PersonType  $personType
         *
         * @return Person
         */
        public function setPersonType(?PersonType $personType):self
        {
            $this->personType = $personType;
    
            return $this;
        }
        
        
    }
