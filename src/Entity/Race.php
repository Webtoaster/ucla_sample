<?php
	
	namespace App\Entity;
	
	use App\Entity\Common\BooleanIsActiveTrait;
	use App\Entity\Common\DescriptionTrait;
	use App\Entity\Common\SortOrderTrait;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\IpTraceable\Traits\IpTraceableEntity;
	use Gedmo\Timestampable\Traits\TimestampableEntity;
	
	/**
	 * Race
	 * @ORM\Table(
	 *     name="race",
	 *     indexes={
	 *          @ORM\Index(name="idx_race_election_id",                                 columns={"election_id"}),
	 *          @ORM\Index(name="idx_race_race_type_id",                                columns={"race_type_id"}),
	 *          @ORM\Index(name="idx_race_association_id",                              columns={"association_id"})
	 *     }
	 * )
	 * @ORM\Entity(
	 *     repositoryClass="App\Repository\RaceRepository",
	 * )
	 */
	class Race
	{
		
		/**
		 * @var int $raceId
		 * @ORM\Column(
		 *     name="race_id",
		 *     type="integer",
		 *     nullable=false,
		 *     options={"unsigned"=true,"comment"="Primary Key for Race"}
		 * )
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		private $raceId;
		
		/**
		 * @var Election $election
		 * @ORM\ManyToOne(
		 *     targetEntity="Election"
		 * )
		 * @ORM\JoinColumn(
		 *     name="election_id",
		 *     referencedColumnName="election_id",
		 *     nullable=true,
		 *     onDelete="SET NULL"
		 * )
		 */
		protected $election;
		
		/**
		 * @var RaceType $raceType
		 * @ORM\ManyToOne(
		 *     targetEntity="RaceType"
		 * )
		 * @ORM\JoinColumn(
		 *     name="race_type_id",
		 *     referencedColumnName="race_type_id",
		 *     onDelete="SET NULL",
		 *     nullable=true
		 * )
		 */
		protected $raceType;
		
		
		/**
		 * @var Association $association
		 * @ORM\ManyToOne(
		 *     targetEntity="Association"
		 * )
		 * @ORM\JoinColumn(
		 *     name="association_id",
		 *     referencedColumnName="association_id",
		 *     nullable=true,
		 *     onDelete="SET NULL"
		 * )
		 */
		protected $association;
		
		
		use SortOrderTrait;
		
		/**
		 * @var string $heading
		 * @ORM\Column(
		 *     name="heading",
		 *     type="string",
		 *     length=128,
		 *     nullable=false,
		 *     options={"fixed"=true,"comment"="line 1 text to describe the Race"}
		 * )
		 */
		private $heading;
		
		/**
		 * @var string|null $subheading
		 * @ORM\Column(
		 *     name="subheading",
		 *     type="string",
		 *     length=128,
		 *     nullable=true,
		 *     options={"fixed"=true,"comment"="line 2 text to describe the Race"}
		 * )
		 */
		private $subheading;
		
		use DescriptionTrait;
		
		/**
		 * @var int|null $selectMin
		 * @ORM\Column(
		 *     name="select_min",
		 *     type="integer",
		 *     nullable=true,
		 *     options={"unsigned"=true,"comment"="Minimum Number of Options Selected"}
		 * )
		 */
		private $selectMin = 0;
		
		/**
		 * @var int|null $selectMax
		 * @ORM\Column(
		 *     name="select_max",
		 *     type="integer",
		 *     nullable=true,
		 *     options={"default"="1","unsigned"=true,"comment"="Maximum Number of Options Selected."}
		 *     )
		 */
		private $selectMax = 1;
		
		/**
		 * @var bool $allowForQuorum
		 * @ORM\Column(
		 *     name="allow_for_quorum",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"=0, "comment"="Boolean - Allow For Quorum Option."}
		 *     )
		 */
		private $allowForQuorum = FALSE;
		
		/**
		 * @var bool $allowForAbstain
		 * @ORM\Column(
		 *     name="allow_for_abstain",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"=0, "comment"="Boolean - Allow for Abstain Option."}
		 *     )
		 */
		private $allowForAbstain = FALSE;
		
		/**
		 * @var bool $displayRandom
		 * @ORM\Column(
		 *     name="display_random",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"=0, "comment"="Boolean - Display Options in Random Order."}
		 *     )
		 */
		private $displayRandom = FALSE;
		
		
		/**
		 * @var string|null $formType
		 * @ORM\Column(
		 *     name="form_type",
		 *     type="string",
		 *     length=32,
		 *     nullable=true,
		 *     options={"fixed"=true,"comment"="This is how the options will be displayed on the online form."}
		 *     )
		 */
		private $formType;
		
		/**
		 * @var string|null $displayMethod
		 * @ORM\Column(
		 *     name="display_method",
		 *     type="string",
		 *     length=32,
		 *     nullable=true,
		 *     options={"fixed"=true,"comment"="This will determine how the online form will be displayed."}
		 *     )
		 */
		private $displayMethod;
		
		/**
		 * @var bool $displayIncumbency
		 * @ORM\Column(
		 *     name="display_incumbency",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"=1,"comment"="Boolean - Display Incumbent Status."}
		 *     )
		 */
		private $displayIncumbency = TRUE;
		
		/**
		 * @var bool $displayDeclared
		 * @ORM\Column(
		 *     name="display_declared",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"="1","comment"="Boolean - Display Declared Candidate."}
		 *     )
		 */
		private $displayDeclared = TRUE;
		
		use IpTraceableEntity;
		use TimestampableEntity;
		use BooleanIsActiveTrait;
		
		
		/**
		 * @return string
		 */
		public function __toString()
		{
			return $this->getHeading();
		}
		
		
		/**
		 * @var bool $displayWriteIn
		 * @ORM\Column(
		 *     name="display_write_in",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"="1","comment"="Boolean - Display if is Write In Candidate."}
		 *     )
		 */
		private $displayWriteIn = TRUE;
		
		/**
		 * @return int|null
		 */
		public function getRaceId():?int
		{
			return $this->raceId;
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
		 * @return Race
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
		 * @return Race
		 */
		public function setSubheading(?string $subheading):self
		{
			$this->subheading = $subheading;
			
			return $this;
		}
		
		
		/**
		 * @return int|null
		 */
		public function getSelectMin():?int
		{
			return $this->selectMin;
		}
		
		/**
		 * @param  int|null  $selectMin
		 *
		 * @return Race
		 */
		public function setSelectMin(?int $selectMin):self
		{
			$this->selectMin = $selectMin;
			
			return $this;
		}
		
		/**
		 * @return int|null
		 */
		public function getSelectMax():?int
		{
			return $this->selectMax;
		}
		
		/**
		 * @param  int|null  $selectMax
		 *
		 * @return Race
		 */
		public function setSelectMax(?int $selectMax):self
		{
			$this->selectMax = $selectMax;
			
			return $this;
		}
		
		/**
		 * @return bool|null
		 */
		public function getAllowForQuorum():?bool
		{
			return $this->allowForQuorum;
		}
		
		/**
		 * @param  bool  $allowForQuorum
		 *
		 * @return Race
		 */
		public function setAllowForQuorum(bool $allowForQuorum):self
		{
			$this->allowForQuorum = $allowForQuorum;
			
			return $this;
		}
		
		/**
		 * @return bool|null
		 */
		public function getAllowForAbstain():?bool
		{
			return $this->allowForAbstain;
		}
		
		/**
		 * @param  bool  $allowForAbstain
		 *
		 * @return Race
		 */
		public function setAllowForAbstain(bool $allowForAbstain):self
		{
			$this->allowForAbstain = $allowForAbstain;
			
			return $this;
		}
		
		/**
		 * @return null|string
		 */
		public function getFormType():?string
		{
			return $this->formType;
		}
		
		/**
		 * @param  null|string  $formType
		 *
		 * @return Race
		 */
		public function setFormType(?string $formType):self
		{
			$this->formType = $formType;
			
			return $this;
		}
		
		/**
		 * @return null|string
		 */
		public function getDisplayMethod():?string
		{
			return $this->displayMethod;
		}
		
		/**
		 * @param  null|string  $displayMethod
		 *
		 * @return Race
		 */
		public function setDisplayMethod(?string $displayMethod):self
		{
			$this->displayMethod = $displayMethod;
			
			return $this;
		}
		
		/**
		 * @return bool|null
		 */
		public function getDisplayIncumbency():?bool
		{
			return $this->displayIncumbency;
		}
		
		/**
		 * @param  bool  $displayIncumbency
		 *
		 * @return Race
		 */
		public function setDisplayIncumbency(bool $displayIncumbency):self
		{
			$this->displayIncumbency = $displayIncumbency;
			
			return $this;
		}
		
		/**
		 * @return bool|null
		 */
		public function getDisplayDeclared():?bool
		{
			return $this->displayDeclared;
		}
		
		/**
		 * @param  bool  $displayDeclared
		 *
		 * @return Race
		 */
		public function setDisplayDeclared(bool $displayDeclared):self
		{
			$this->displayDeclared = $displayDeclared;
			
			return $this;
		}
		
		/**
		 * @return bool|null
		 */
		public function getDisplayWriteIn():?bool
		{
			return $this->displayWriteIn;
		}
		
		/**
		 * @param  bool  $displayWriteIn
		 *
		 * @return Race
		 */
		public function setDisplayWriteIn(bool $displayWriteIn):self
		{
			$this->displayWriteIn = $displayWriteIn;
			
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
		 * @return Race
		 */
		public function setElection(?Election $election):self
		{
			$this->election = $election;
			
			return $this;
		}
		
		/**
		 * @return RaceType|null
		 */
		public function getRaceType():?RaceType
		{
			return $this->raceType;
		}
		
		/**
		 * @param  RaceType|null  $raceType
		 *
		 * @return Race
		 */
		public function setRaceType(?RaceType $raceType):self
		{
			$this->raceType = $raceType;
			
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
		 * @return Race
		 */
		public function setAssociation(?Association $association):self
		{
			$this->association = $association;
			
			return $this;
		}
		
		
		/**
		 * @return bool|null
		 */
		public function getDisplayRandom():?bool
		{
			return $this->displayRandom;
		}
		
		
		/**
		 * @param  bool  $displayRandom
		 *
		 * @return $this
		 */
		public function setDisplayRandom(bool $displayRandom):self
		{
			$this->displayRandom = $displayRandom;
			
			return $this;
		}
		
	}
