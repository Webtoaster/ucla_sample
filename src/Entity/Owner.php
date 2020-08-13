<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\AddressEmailTrait;
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
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
    use Symfony\Component\Security\Core\User\UserInterface;
    
    /**
     * Voter
     *
     * @ORM\Table(
     *     name="owner",
     *     indexes={
     *         @ORM\Index(name="idx_owner_phone_work", columns={"phone_work"}),
     *         @ORM\Index(name="idx_owner_un", columns={"un"}),
     *         @ORM\Index(name="idx_owner_email", columns={"email"}),
     *         @ORM\Index(name="idx_owner_phone_home", columns={"phone_home"}),
     *         @ORM\Index(name="idx_owner_phone_mobile", columns={"phone_mobile"})
     *     }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\OwnerRepository",
     * )
     *
     *
     * @UniqueEntity(fields={"un"}, message="There is already an account with this User Name.")
     *
     *
     */
    class Owner implements UserInterface
    {
    
        /**
         * @var int $ownerId
         *
         * @ORM\Column(
         *     name="owner_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for Owner"})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $ownerId;
    
    
        /**
         * @return null|int
         */
        public function getId():?int
        {
            return $this->ownerId;
        }
        
        
        use NameFormalTrait;
        use NameHumanTrait;
    
        use AddressEmailTrait;
    
        use PhoneWorkTrait;
        use PhoneHomeTrait;
        use PhoneMobileTrait;
        use PhoneFaxTrait;
    
        use UsernameUniqueTrait;
        use PasswordTrait;
        use RolesTrait;
        use CredentialsTrait;
    
        use AddressPhysicalTrait;
        use AddressMailingTrait;
    
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        
        
        /**
         * Owner constructor.
         */
        public function __construct()
        {
            /**
             * Concatenate and Insert the names submitted if the display_name is not assigned.
             */
            if ($this->nameFormal === NULL || trim($this->nameFormal) === '') {
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
        public function getOwnerId():?int
        {
            return $this->ownerId;
        }
    
    
        /**
         * A visual identifier that represents this user.
         *
         * @see UserInterface
         */
        public function getUsername():?string
        {
            return (string)$this->getUn();
        }
    
    
    }
