<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use DateTime;
    use DateTimeInterface;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * AssociationStaff
     *
     * @ORM\Table(
     *      name="association_staff",
     *      indexes={
     *          @ORM\Index(name="fk_idx_association_staff_member_to_person", columns={"person_id"}),
     *          @ORM\Index(name="fk_idx_association_staff_member_to_association", columns={"association_id"})
     *      }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\AssociationStaffRepository",
     * )
     */
    class AssociationStaff
    {
    
    
        /**
         * @var int $associationStaffId
         *
         * @ORM\Column(
         *     name="association_staff_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for table"}
         *     )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $associationStaffId;
    
        /**
         * @var Association|null $association
         *
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\Association"
         * )
         *
         * @ORM\JoinColumn(
         *     name="association_id",
         *     referencedColumnName="association_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        protected $association;
    
    
        /**
         * @var Person|null $person
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\Person"
         * )
         *
         * @ORM\JoinColumn(
         *     name="person_id",
         *     referencedColumnName="id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        protected $person;
    
        /**
         * @var bool $isAttorney
         *
         * @ORM\Column(
         *     name="is_attorney",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="flag if staff member is attorney"}
         *     )
         */
        private $isAttorney = FALSE;
        
        
        /**
         * @var string|null $jobTitle
         *
         * @ORM\Column(
         *     name="job_title",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="descripton of off job"}
         *     )
         */
        private $jobTitle;
    
        /**
         * @var bool $isBoardMember
         *
         * @ORM\Column(
         *     name="is_board_member",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Is this Staff Member a Board Member" })
         */
        private $isBoardMember = FALSE;
        
        /**
         * @var DateTime|null $dateStart
         *
         * @ORM\Column(
         *     name="date_start",
         *     type="datetime",
         *     nullable=true
         *     )
         */
        private $dateStart;
    
    
        /**
         * @var DateTime|null $dateEnd
         *
         * @ORM\Column(
         *     name="date_end",
         *     type="datetime",
         *     nullable=true
         *     )
         */
        private $dateEnd;
    
    
        /**
         * @ORM\OneToMany(
         *     targetEntity="App\Entity\AssociationStaffPermission",
         *     mappedBy="associationStaff"
         * )
         */
        private $associationStaffPermissions;
    
    
        // @formatter:off
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        // @formatter:on
    
    
        /**
         * AssociationStaff constructor.
         */
        public function __construct()
        {
            $this->associationStaffPermissions = new ArrayCollection();
        }
    
    
        /**
         * @return string
         */
        public function __toString()
        {
            // TODO: Implement __toString() method.
            return '';
        }
    
        /**
         * @return int|null
         */
        public function getAssociationStaffId():?int
        {
            return $this->associationStaffId;
        }
    
        /**
         * @return Association|null
         */
        public function getAssociation():?Association
        {
            return $this->association;
        }
    
        /**
         * @param  Association|null  $association
         *
         * @return AssociationStaff
         */
        public function setAssociation(?Association $association):self
        {
            $this->association = $association;
    
            return $this;
        }
    
        /**
         * @return Person|null
         */
        public function getPerson():?Person
        {
            return $this->person;
        }
    
        /**
         * @param  Person|null  $person
         *
         * @return AssociationStaff
         */
        public function setPerson(?Person $person):self
        {
            $this->person = $person;
    
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getIsAttorney():?bool
        {
            return $this->isAttorney;
        }
    
        /**
         * @param  bool  $isAttorney
         *
         * @return AssociationStaff
         */
        public function setIsAttorney(bool $isAttorney):self
        {
            $this->isAttorney = $isAttorney;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getJobTitle():?string
        {
            return $this->jobTitle;
        }
    
        /**
         * @param  string|null  $jobTitle
         *
         * @return AssociationStaff
         */
        public function setJobTitle(?string $jobTitle):self
        {
            $this->jobTitle = $jobTitle;
    
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getIsBoardMember():?bool
        {
            return $this->isBoardMember;
        }
    
        /**
         * @param  bool  $isBoardMember
         *
         * @return AssociationStaff
         */
        public function setIsBoardMember(bool $isBoardMember):self
        {
            $this->isBoardMember = $isBoardMember;
    
            return $this;
        }
    
        /**
         * @return DateTimeInterface|null
         */
        public function getDateStart():?DateTimeInterface
        {
            return $this->dateStart;
        }
    
        /**
         * @param  DateTimeInterface|null  $dateStart
         *
         * @return AssociationStaff
         */
        public function setDateStart(? DateTimeInterface $dateStart):self
        {
            $this->dateStart = $dateStart;
    
            return $this;
        }
    
        /**
         * @return DateTimeInterface|null
         */
        public function getDateEnd():?DateTimeInterface
        {
            return $this->dateEnd;
        }
    
        /**
         * @param  DateTimeInterface|null  $dateEnd
         *
         * @return AssociationStaff
         */
        public function setDateEnd(? DateTimeInterface $dateEnd):self
        {
            $this->dateEnd = $dateEnd;
    
            return $this;
        }
    
        /**
         * @return Collection|AssociationStaffPermission[]
         */
        public function getAssociationStaffPermissions():Collection
        {
            return $this->associationStaffPermissions;
        }
    
        /**
         * @param  AssociationStaffPermission  $associationStaffPermission
         *
         * @return AssociationStaff
         */
        public function addAssociationStaffPermission(AssociationStaffPermission $associationStaffPermission):self
        {
            if (!$this->associationStaffPermissions->contains($associationStaffPermission)) {
                $this->associationStaffPermissions[] = $associationStaffPermission;
                $associationStaffPermission->setAssociationStaff($this);
            }
    
            return $this;
        }
    
        /**
         * @param  AssociationStaffPermission  $associationStaffPermission
         *
         * @return AssociationStaff
         */
        public function removeAssociationStaffPermission(AssociationStaffPermission $associationStaffPermission):self
        {
            if ($this->associationStaffPermissions->contains($associationStaffPermission)) {
                $this->associationStaffPermissions->removeElement($associationStaffPermission);
                // set the owning side to null (unless already changed)
                if ($associationStaffPermission->getAssociationStaff() === $this) {
                    $associationStaffPermission->setAssociationStaff(NULL);
                }
            }
    
            return $this;
        }
    
    
    }
