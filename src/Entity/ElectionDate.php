<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\DescriptionTrait;
    use DateTime;
    use DateTimeInterface;
    use Doctrine\ORM\Mapping as ORM;
    use Exception;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * ElectionDate
     *
     * @ORM\Table(
     *     name="election_date",
     *     indexes={
     *          @ORM\Index(name="idx_election_date_election_id", columns={"date_value"}),
     *          @ORM\Index(name="fk_idx_election_date_election_id", columns={"election_id"})
     *      }
     * )
     * @ORM\Entity(
     *     repositoryClass="App\Repository\ElectionDateRepository",
     * )
     */
    class ElectionDate
    {
    
    
        /**
         * @var int $electionDateId
         *
         * @ORM\Column(
         *     name="election_date_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for Election_Date"}
         * )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $electionDateId;
    
        /**
         * @var Election|null $election
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\Election"
         * )
         *
         * @ORM\JoinColumn(
         *     name="election_id",
         *     referencedColumnName="election_id",
         *     onDelete="SET NULL"
         * )
         */
        protected $election;
    
        /**
         * @var DateTime|null $dateValue
         *
         * @Assert\NotBlank
         *
         * @Assert\Type("\DateTime")
         *
         * @ORM\Column(
         *     name="date_value",
         *     type="datetime",
         *     nullable=false,
         *     options={"comment"="Date of the Election Event"}
         * )
         */
        private $dateValue;
    
    
        use DescriptionTrait;
    
        // @formatter:off
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        // @formatter:on
    
        /**
         * ElectionDate constructor.
         */
        public function __construct()
        {
        }
    
        /**
         * @throws Exception
         * @return string
         */
        public function __toString()
        {
            return $this->getDateString().' '.$this->getDescriptionShort();
        }
    
    
        /**
         * @throws Exception
         * @return string
         */
        private function getDateString():string
        {
            $date = new DateTime($this->getDateValue());
    
            return date_format($date, 'F j, Y');
        }
    
    
        /**
         * @return int|null
         */
        public function getElectionDateId():?int
        {
            return $this->electionDateId;
        }
    
        /**
         * @return DateTimeInterface|null
         */
        public function getDateValue():?DateTimeInterface
        {
            return $this->dateValue;
        }
    
        /**
         * @param  DateTimeInterface  $dateValue
         *
         * @return ElectionDate
         */
        public function setDateValue(DateTimeInterface $dateValue):self
        {
            $this->dateValue = $dateValue;
    
            return $this;
        }
    
    
        /**
         * @return Election|null
         */
        public function getElection():?Election
        {
            return $this->election;
        }
    
        /**
         * @param  Election|null  $election
         *
         * @return ElectionDate
         */
        public function setElection(?Election $election):self
        {
            $this->election = $election;
    
            return $this;
        }
    
    
    }
