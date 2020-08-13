<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Association
     *
     * @ORM\Table(
     *     name="association",
     *     indexes={
     *          @ORM\Index(name="fk_idx_association_to_company", columns={"company_id"})
     *     }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\AssociationRepository",
     * )
     */
    class Association
    {
    
    
        /**
         * @Assert\GreaterThanOrEqual(1)
         *
         * @var int $associationId
         *
         * @ORM\Column(
         *     name="association_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for association"}
         *     )
         *
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $associationId;
    
        // /**
        //  * @var Property $property
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="Property",
        //  *     mappedBy="association"
        //  * )
        //  */
        // protected $property;
    
        // /**
        //  * @var Owner $owner
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="Owner",
        //  *     mappedBy="association"
        //  * )
        //  */
        // protected $owner;
    
        // /**
        //  * checked
        //  *
        //  * @var AssociationStaff $associationStaff
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="AssociationStaff",
        //  *     mappedBy="association"
        //  * )
        //  */
        // protected $associationStaff;
    
        // /**
        //  * checked
        //  *
        //  * @var Election $election
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="Election",
        //  *     mappedBy="association"
        //  * )
        //  */
        // protected $election;
    
        /**
         * @var Company $company
         *
         * @Assert\NotBlank(
         *     message="You must select an Association."
         * )
         *
         * @ORM\ManyToOne(
         *     targetEntity="Company"
         * )
         *
         * @ORM\JoinColumn(
         *     name="company_id",
         *     referencedColumnName="company_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        protected $company;
    
    
        // @formatter:off
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        // @formatter:on
    
    
        /**
         * Association constructor.
         */
        public function __construct()
        {
        }
    
        /**
         * @return string
         */
        public function __toString():?string
        {
            return '';
            // return $this->getCompany()->getCompanyName();
        }
    
        /**
         * @return int|null
         */
        public function getAssociationId():?int
        {
            return $this->associationId;
        }
    
        /**
         * @return Company|null
         */
        public function getCompany():?Company
        {
            return $this->company;
        }
    
        /**
         * @param  Company|null  $company
         *
         * @return Association
         */
        public function setCompany(?Company $company):self
        {
            $this->company = $company;
    
            return $this;
        }
    
    
    }
