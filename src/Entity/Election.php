<?php
    
    namespace App\Entity;

    use App\Entity\Common\AddressMailingTrait;
    use App\Entity\Common\AddressPhysicalTrait;
    use App\Entity\Common\BooleanIsActiveTrait;
    use DateTime;
    use DateTimeInterface;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * Election
     *
     * @ORM\Table(name="election", indexes={@ORM\Index(name="fk_idx_election_to_association", columns={"association_id"}), @ORM\Index(name="idx_election_date_end", columns={"date_end"}), @ORM\Index(name="idx_election_date_start", columns={"date_start"})})
     * @ORM\Entity(
     *     repositoryClass="App\Repository\ElectionRepository",
     * )
     */
    class Election
    {
    
        /**
         * @var int $electionId
         *
         * @ORM\Column(
         *     name="election_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for election"})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $electionId;
    
        /**
         * @var Association $association
         *
         * @ORM\ManyToOne(
         *     targetEntity="Association"
         * )
         *
         * @ORM\JoinColumn(
         *     name="association_id",
         *     referencedColumnName="association_id"
         * )
         */
        protected $association;
    
    
        // /**
        //  * @var Race $race
        //  *
        //  * @ORM\OneToMany(
        //  *     targetEntity="Race",
        //  *     mappedBy="election"
        //  * )
        //  */
        // protected $race;
    
        /**
         * @var string $heading
         *
         * @ORM\Column(
         *     name="heading",
         *     type="string",
         *     length=128,
         *     nullable=false,
         *     options={"fixed"=true,"comment"="line 1 text to describe the election"})
         */
        private $heading;
    
        /**
         * @var string|null $subheading
         * @ORM\Column(
         *     name="subheading",
         *     type="string",
         *     length=512,
         *     nullable=true,
         *     options={"fixed"=false,"comment"="line 2 text to describe the election"}
         * )
         */
        private $subheading;
    
        /**
         * @var string $information
         *
         * @ORM\Column(
         *     name="information",
         *     type="text", length=65535,
         *     nullable=false,
         *     options={"comment"="html describing the election"})
         */
        private $information;
    
        /**
         * @var DateTime $dateStart
         *
         * @ORM\Column(
         *     name="date_start",
         *     type="datetime",
         *     nullable=false,
         *     options={"comment"="Date and Time when Voting Starts"})
         */
        private $dateStart;
    
        /**
         * @var DateTime $dateEnd
         *
         * @ORM\Column(
         *     name="date_end",
         *     type="datetime",
         *     nullable=false,
         *     options={"comment"="Date and Time when Voting Ends"})
         */
        private $dateEnd;
    
        /**
         * @var bool $displayPhysicalAddress
         *
         * @ORM\Column(
         *     name="display_physical_address",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=1,"comment"="Display the Physical Address on the form."})
         */
        private $displayPhysicalAddress = TRUE;
    
        /**
         * @var bool $displayMailingAddress
         *
         * @ORM\Column(
         *     name="display_mailing_address",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=1,"comment"="display the Mailing Address on the form."})
         */
        private $displayMailingAddress = TRUE;
    
        /**
         * @var string|null $electionState
         *
         * @ORM\Column(
         *     name="election_state",
         *     type="string",
         *     length=2,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Physical Address State"}
         *     )
         */
        private $electionState;
    
        /**
         * @var int $votesMax
         *
         * @ORM\Column(
         *     name="votes_max",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Total number of voters"})
         */
        private $votesMax;
    
        /**
         * @var int $votesMin
         *
         * @ORM\Column(
         *     name="votes_min",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Minimum number of voters required to participate"})
         */
        private $votesMin;
    
        /**
         * @var int $voterMinPercent
         *
         * @ORM\Column(
         *     name="voter_min_percent",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Minimum percentage of voters_total required to participate"})
         */
        private $voterMinPercent;
    
        // /**
	    //  * @var bool|null $allowProxyVoting
	    //  *
	    //  * @ORM\Column(
	    //  *     name="is_draft",
	    //  *     type="boolean",
	    //  *     nullable=true,
	    //  *     options={"default"=0, "comment"="Mark this Election as a Draft Election."})
	    //  */
	    // private $isDraft = FALSE;
	
	    /**
         * @var bool|null $allowProxyVoting
         *
         * @ORM\Column(
         *     name="allow_proxy_voting",
         *     type="boolean",
         *     nullable=true,
         *     options={"default"=1, "comment"="Allow for Proxy Votes"})
         */
        private $allowProxyVoting = TRUE;
    
        /**
         * @var bool|null $allowInPersonVoting
         *
         * @ORM\Column(
         *     name="allow_in_person_voting",
         *     type="boolean",
         *     nullable=true,
         *     options={"default"=1,"comment"="Allow for In Person Voting"})
         */
        private $allowInPersonVoting = TRUE;
    
        /**
         * @var bool|null $allowWriteInCandidates
         *
         * @ORM\Column(
         *     name="allow_write_in_candidates",
         *     type="boolean",
         *     nullable=true,
         *     options={"default"=0, "comment"="Allow for Write In Candidates to be added"})
         */
        private $allowWriteInCandidates = FALSE;
    
        /**
         * @var bool|null $allowProxyDirected
         *
         * @ORM\Column(
         *     name="allow_proxy_directed",
         *     type="boolean",
         *     nullable=true,
         *     options={"default"=0,"comment"="Allow for Directed Proxies to be submitted."})
         */
        private $allowProxyDirected = FALSE;
    
        /**
         * @var bool|null $allowProxyNondirected
         *
         * @ORM\Column(
         *     name="allow_proxy_nondirected",
         *     type="boolean",
         *     nullable=true,
         *     options={"default"=0,"comment"="Allow for Non-Directed Proxies to be submitted."})
         */
        private $allowProxyNondirected = FALSE;
    
        /**
         * @var bool|null $allowProxyRevocation
         *
         * @ORM\Column(
         *     name="allow_proxy_revocation",
         *     type="boolean",
         *     nullable=true,
         *     options={"default"=0,"comment"="Allow for Voter to Revoke a Proxy."})
         */
        private $allowProxyRevocation = FALSE;
    
        /**
         * @var bool|null $allowMailInBallots
         *
         * @ORM\Column(
         *     name="allow_mail_in_ballots",
         *     type="boolean",
         *     nullable=true,
         *     options={"default"=0,"comment"="Allow for Voter to Mail In a Ballot."})
         */
        private $allowMailInBallots = FALSE;
    
        /**
         * @var bool|null $allowPublicResults
         *
         * @ORM\Column(
         *     name="allow_public_results",
         *     type="boolean",
         *     nullable=true,
         *     options={"default"=0,"comment"="Allow for Results to be posted publicly on this Website."})
         */
        private $allowPublicResults = FALSE;
    
        /**
         * @var string|null $urlElection
         *
         * @ORM\Column(
         *     name="url_election",
         *     type="string", length=180,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="url link to get to page describing the election"})
         */
        private $urlElection;
    
        /**
         * @var string|null $urlRules
         *
         * @ORM\Column(
         *     name="url_rules",
         *     type="string", length=180,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="url link to get to page describing the election"})
         */
        private $urlRules;
    
        public function __construct()
        {
        }
	
	
	    /**
	     * @return string
	     */
	    public function __toString()
	    {
		    return $this->getHeading();
	    }
	
	
	    use AddressPhysicalTrait;
        use AddressMailingTrait;
    
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
    
        /**
         * @return int|null
         */
        public function getElectionId():?int
        {
            return $this->electionId;
        }
    
        /**
         * @return string
         */
        public function getHeading():string
        {
	        return $this->heading;
        }
    
        /**
         * @param  string  $heading
         *
         * @return Election
         */
        public function setHeading(string $heading):self
        {
            $this->heading = $heading;
        
            return $this;
        }
    
        /**
         * @return null|string
         */
        public function getSubheading():?string
        {
            return $this->subheading;
        }
    
        /**
         * @param  null|string  $subheading
         *
         * @return Election
         */
        public function setSubheading(?string $subheading):self
        {
            $this->subheading = $subheading;
        
            return $this;
        }
    
        /**
         * @return null|string
         */
        public function getInformation():?string
        {
            return $this->information;
        }
    
        /**
         * @param  string  $information
         *
         * @return Election
         */
        public function setInformation(string $information):self
        {
            $this->information = $information;
        
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
         * @param  DateTimeInterface  $dateStart
         *
         * @return Election
         */
        public function setDateStart(DateTimeInterface $dateStart):self
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
         * @param  DateTimeInterface  $dateEnd
         *
         * @return Election
         */
        public function setDateEnd(DateTimeInterface $dateEnd):self
        {
            $this->dateEnd = $dateEnd;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getDisplayPhysicalAddress():?bool
        {
            return $this->displayPhysicalAddress;
        }
    
        /**
         * @param  bool  $displayPhysicalAddress
         *
         * @return Election
         */
        public function setDisplayPhysicalAddress(bool $displayPhysicalAddress):self
        {
            $this->displayPhysicalAddress = $displayPhysicalAddress;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getDisplayMailingAddress():?bool
        {
            return $this->displayMailingAddress;
        }
    
        /**
         * @param  bool  $displayMailingAddress
         *
         * @return Election
         */
        public function setDisplayMailingAddress(bool $displayMailingAddress):self
        {
            $this->displayMailingAddress = $displayMailingAddress;
        
            return $this;
        }
    
        /**
         * @return null|string
         */
        public function getElectionState():?string
        {
            return $this->electionState;
        }
    
        /**
         * @param  null|string  $electionState
         *
         * @return Election
         */
        public function setElectionState(?string $electionState):self
        {
            $this->electionState = $electionState;
        
            return $this;
        }
    
        /**
         * @return int|null
         */
        public function getVotesMax():?int
        {
            return $this->votesMax;
        }
    
        /**
         * @param  int  $votesMax
         *
         * @return Election
         */
        public function setVotesMax(int $votesMax):self
        {
            $this->votesMax = $votesMax;
        
            return $this;
        }
    
        /**
         * @return int|null
         */
        public function getVotesMin():?int
        {
            return $this->votesMin;
        }
    
        /**
         * @param  int  $votesMin
         *
         * @return Election
         */
        public function setVotesMin(int $votesMin):self
        {
            $this->votesMin = $votesMin;
        
            return $this;
        }
    
        /**
         * @return int|null
         */
        public function getVoterMinPercent():?int
        {
            return $this->voterMinPercent;
        }
    
        /**
         * @param  int  $voterMinPercent
         *
         * @return Election
         */
        public function setVoterMinPercent(int $voterMinPercent):self
        {
            $this->voterMinPercent = $voterMinPercent;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getAllowProxyVoting():?bool
        {
            return $this->allowProxyVoting;
        }
    
        /**
         * @param  bool|null  $allowProxyVoting
         *
         * @return Election
         */
        public function setAllowProxyVoting(?bool $allowProxyVoting):self
        {
            $this->allowProxyVoting = $allowProxyVoting;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getAllowInPersonVoting():?bool
        {
            return $this->allowInPersonVoting;
        }
    
        /**
         * @param  bool|null  $allowInPersonVoting
         *
         * @return Election
         */
        public function setAllowInPersonVoting(?bool $allowInPersonVoting):self
        {
            $this->allowInPersonVoting = $allowInPersonVoting;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getAllowWriteInCandidates():?bool
        {
            return $this->allowWriteInCandidates;
        }
    
        /**
         * @param  bool|null  $allowWriteInCandidates
         *
         * @return Election
         */
        public function setAllowWriteInCandidates(?bool $allowWriteInCandidates):self
        {
            $this->allowWriteInCandidates = $allowWriteInCandidates;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getAllowProxyDirected():?bool
        {
            return $this->allowProxyDirected;
        }
    
        /**
         * @param  bool|null  $allowProxyDirected
         *
         * @return Election
         */
        public function setAllowProxyDirected(?bool $allowProxyDirected):self
        {
            $this->allowProxyDirected = $allowProxyDirected;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getAllowProxyNondirected():?bool
        {
            return $this->allowProxyNondirected;
        }
    
        /**
         * @param  bool|null  $allowProxyNondirected
         *
         * @return Election
         */
        public function setAllowProxyNondirected(?bool $allowProxyNondirected):self
        {
            $this->allowProxyNondirected = $allowProxyNondirected;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getAllowProxyRevocation():?bool
        {
            return $this->allowProxyRevocation;
        }
    
        /**
         * @param  bool|null  $allowProxyRevocation
         *
         * @return Election
         */
        public function setAllowProxyRevocation(?bool $allowProxyRevocation):self
        {
            $this->allowProxyRevocation = $allowProxyRevocation;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getAllowMailInBallots():?bool
        {
            return $this->allowMailInBallots;
        }
    
        /**
         * @param  bool|null  $allowMailInBallots
         *
         * @return Election
         */
        public function setAllowMailInBallots(?bool $allowMailInBallots):self
        {
            $this->allowMailInBallots = $allowMailInBallots;
        
            return $this;
        }
    
        /**
         * @return bool|null
         */
        public function getAllowPublicResults():?bool
        {
            return $this->allowPublicResults;
        }
    
        /**
         * @param  bool|null  $allowPublicResults
         *
         * @return Election
         */
        public function setAllowPublicResults(?bool $allowPublicResults):self
        {
            $this->allowPublicResults = $allowPublicResults;
        
            return $this;
        }
    
        /**
         * @return null|string
         */
        public function getUrlElection():?string
        {
            return $this->urlElection;
        }
    
        /**
         * @param  null|string  $urlElection
         *
         * @return Election
         */
        public function setUrlElection(?string $urlElection):self
        {
            $this->urlElection = $urlElection;
        
            return $this;
        }
    
        /**
         * @return null|string
         */
        public function getUrlRules():?string
        {
            return $this->urlRules;
        }
    
        /**
         * @param  null|string  $urlRules
         *
         * @return Election
         */
        public function setUrlRules(?string $urlRules):self
        {
            $this->urlRules = $urlRules;
        
            return $this;
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
         * @return Election
         */
        public function setAssociation(?Association $association):self
        {
            $this->association = $association;
        
            return $this;
        }
    
    
    }
