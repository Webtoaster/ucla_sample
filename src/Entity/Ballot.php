<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * Ballot
     *
     * @ORM\Table(
     *     name="ballot",
     *     indexes={
     *          @ORM\Index(name="idx_ballot_race_id",                                 columns={"race_id"}),
     *          @ORM\Index(name="idx_ballot_election_id",                             columns={"election_id"}),
     *          @ORM\Index(name="idx_ballot_owner_id",                                columns={"owner_id"}),
     *          @ORM\Index(name="idx_ballot_ballot_status_id",                        columns={"ballot_status_id"}),
     *          @ORM\Index(name="idx_ballot_proxy_id",                                columns={"proxy_id"}),
     *          @ORM\Index(name="idx_ballot_proxy_status_id",                         columns={"proxy_status_id"}),
     *          @ORM\Index(name="idx_ballot_property_id",                             columns={"property_id"})
     *     }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\BallotRepository",
     *
     * )
     *
     */
    class Ballot
    {
    
        /**
         * @var int $ballotId
         *
         * @ORM\Column(
         *     name="ballot_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for ballot."})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $ballotId;
    
    
        // /**
        //  * @var Vote $vote
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="Vote",
        //  *     mappedBy="ballot"
        //  * )
        //  */
        // protected $vote;
    
        /**
         * @var Race $race
         *
         * @ORM\ManyToOne(
         *     targetEntity="Race"
         * )
         * @ORM\JoinColumn(
         *     name="race_id",
         *     referencedColumnName="race_id",
         *     nullable=false
         * )
         */
        protected $race;
    
        /**
         * @var Election $election
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\Election"
         * )
         *
         * @ORM\JoinColumn(
         *     name="election_id",
         *     referencedColumnName="election_id",
         *     nullable=false
         * )
         */
        protected $election;
    
        /**
         * @var Owner $owner
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\Owner"
         * )
         *
         * @ORM\JoinColumn(
         *     name="owner_id",
         *     referencedColumnName="owner_id",
         *     nullable=false
         * )
         */
        protected $owner;
    
    
        /**
         * @var Owner $proxy
         *
         * @ORM\ManyToOne(
         *     targetEntity="Owner"
         * )
         * @ORM\JoinColumn(
         *     name="proxy_id",
         *     referencedColumnName="owner_id",
         *     nullable=true
         * )
         */
        protected $proxy;
    
        /**
         * @var BallotStatus $ballotStatus
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\BallotStatus"
         * )
         *
         * @ORM\JoinColumn(
         *     name="ballot_status_id",
         *     referencedColumnName="ballot_status_id",
         *     nullable=false,
         * )
         */
        protected $ballotStatus;
    
        /**
         * @var int|null $proxyStatus
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\ProxyStatus"
         * )
         *
         * @ORM\JoinColumn(
         *     name="proxy_status_id",
         *     referencedColumnName="proxy_status_id",
         *     nullable=false,
         *
         * )
         */
        protected $proxyStatus = 100;
    
        /**
         * @var Property $property
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\Property"
         * )
         *
         * @ORM\JoinColumn(
         *     name="property_id",
         *     referencedColumnName="property_id",
         *     nullable=false
         * )
         *
         */
        protected $property;
    
        /**
         * @var string|null $proxyKey
         *
         * @ORM\Column(
         *     name="proxy_key",
         *     nullable=true,
         *     length=32,
         *     type="string",
         *     unique=false
         * )
         */
        private $proxyKey;
    
        // @formatter:off
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        // @formatter:on
    
        public function __construct()
        {
        }
    
        /**
         * @return string
         */
        public function __toString()
        {
            return '';
            // TODO: Implement __toString() method.
        }
    
    
        /**
         * @return Owner
         */
        public function getProxy():Owner
        {
            return $this->proxy;
        }
    
        /**
         * @param  Owner  $proxy
         *
         * @return Ballot
         */
        public function setProxy(Owner $proxy):Ballot
        {
            $this->proxy = $proxy;
    
            return $this;
        }
    
        /**
         * @return int|null
         */
        public function getProxyStatus():?int
        {
            return $this->proxyStatus;
        }
    
        /**
         * @param  int|null  $proxyStatus
         *
         * @return Ballot
         */
        public function setProxyStatus(?int $proxyStatus):Ballot
        {
            $this->proxyStatus = $proxyStatus;
    
            return $this;
        }
    
        /**
         * @return null|string
         */
        public function getProxyKey():?string
        {
            return $this->proxyKey;
        }
    
        /**
         * @param  null|string  $proxyKey
         *
         * @return Ballot
         */
        public function setProxyKey(?string $proxyKey):Ballot
        {
            $this->proxyKey = $proxyKey;
    
            return $this;
        }
    
    
        /**
         * @return int
         */
        public function getBallotId():int
        {
            return $this->ballotId;
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
         * @return Ballot
         */
        public function setElection(?Election $election):self
        {
            $this->election = $election;
    
            return $this;
        }
    
        /**
         * @return Race|null
         */
        public function getRace():?Race
        {
            return $this->race;
        }
    
        /**
         * @param  Race|null  $race
         *
         * @return Ballot
         */
        public function setRace(?Race $race):self
        {
            $this->race = $race;
    
            return $this;
        }
    
        /**
         * @return Owner|null
         */
        public function getOwner():?Owner
        {
            return $this->owner;
        }
    
        /**
         * @param  Owner|null  $owner
         *
         * @return Ballot
         */
        public function setOwner(?Owner $owner):self
        {
            $this->owner = $owner;
    
            return $this;
        }
    
        /**
         * @return Property|null
         */
        public function getProperty():?Property
        {
            return $this->property;
        }
    
        /**
         * @param  Property|null  $property
         *
         * @return Ballot
         */
        public function setProperty(?Property $property):self
        {
            $this->property = $property;
    
            return $this;
        }
    
        /**
         * @return BallotStatus|null
         */
        public function getBallotStatus():?BallotStatus
        {
            return $this->ballotStatus;
        }
    
        /**
         * @param  BallotStatus|null  $ballotStatus
         *
         * @return Ballot
         */
        public function setBallotStatus(?BallotStatus $ballotStatus):self
        {
            $this->ballotStatus = $ballotStatus;
    
            return $this;
        }
    
    
    }
