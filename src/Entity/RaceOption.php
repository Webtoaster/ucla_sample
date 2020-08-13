<?php
	
	namespace App\Entity;
	
	use App\Entity\Common\AddressEmailTrait;
	use App\Entity\Common\AddressMailingTrait;
	use App\Entity\Common\AddressPhysicalTrait;
	use App\Entity\Common\BooleanIsActiveTrait;
	use App\Entity\Common\DescriptionShortTrait;
	use App\Entity\Common\DisplayMailingAddressTrait;
	use App\Entity\Common\DisplayPhysicalAddressTrait;
	use App\Entity\Common\NameFormalTrait;
	use App\Entity\Common\NameHumanTrait;
	use App\Entity\Common\PhoneFaxTrait;
	use App\Entity\Common\PhoneHomeTrait;
	use App\Entity\Common\PhoneMobileTrait;
	use App\Entity\Common\PhoneWorkTrait;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\IpTraceable\Traits\IpTraceableEntity;
	use Gedmo\Timestampable\Traits\TimestampableEntity;
	
	/**
	 * RaceOption
	 * @ORM\Table(
	 *     name="race_option",
	 *     indexes={
	 *
	 *          @ORM\Index(name="idx_race_option_name_formal",                  columns={"name_formal"}),
	 *          @ORM\Index(name="idx_race_option_name_first",                   columns={"name_first"}),
	 *          @ORM\Index(name="idx_race_option_name_middle",                  columns={"name_middle"}),
	 *          @ORM\Index(name="idx_race_option_name_last",                    columns={"name_last"}),
	 *          @ORM\Index(name="idx_race_option_race_id",                      columns={"race_id"}),
	 *          @ORM\Index(name="fk_idx_race_option_write_in_by_voter_id",      columns={"write_in_by_owner_id"})
	 *     }
	 * )
	 * @ORM\Entity(
	 *     repositoryClass="App\Repository\RaceOptionRepository",
	 * )
	 */
	class RaceOption
	{
		
		/**
		 * @var int $raceOptionId
		 * @ORM\Column(
		 *     name="race_option_id",
		 *     type="integer",
		 *     nullable=false,
		 *     options={"unsigned"=true,"comment"="Primary Key for Option or Candidate."})
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		private $raceOptionId;
		
		
		// /**
		//  * @var Vote $vote
		//  *
		//  * @ORM\OneToMany(
		//  *     targetEntity="Vote",
		//  *     mappedBy="raceOption"
		//  * )
		//  */
		// protected $vote;
		
		/**
		 * @var Race|null $race
		 * @ORM\ManyToOne(
		 *     targetEntity="App\Entity\Race"
		 * )
		 * @ORM\JoinColumn(
		 *     name="race_id",
		 *     referencedColumnName="race_id",
		 *     nullable=true,
		 *     onDelete="SET NULL"
		 * )
		 */
		protected $race;
		
		/**
		 * @var Owner|null $writeInByOwner
		 * @ORM\ManyToOne(
		 *     targetEntity="App\Entity\Owner"
		 * )
		 * @ORM\JoinColumn(
		 *     name="write_in_by_owner_id",
		 *     referencedColumnName="owner_id",
		 *     nullable=true,
		 *     onDelete="SET NULL"
		 * )
		 */
		protected $writeInByOwner;
		
		
		use DescriptionShortTrait;
		
		use NameFormalTrait;
		
		use NameHumanTrait;
		
		use AddressEmailTrait;
		
		use PhoneWorkTrait;
		use PhoneHomeTrait;
		use PhoneMobileTrait;
		use PhoneFaxTrait;
		
		use AddressPhysicalTrait;
		use DisplayPhysicalAddressTrait;
		
		use AddressMailingTrait;
		use DisplayMailingAddressTrait;
		
		
		/**
		 * @var bool $isPerson
		 * @ORM\Column(
		 *     name="is_person",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"=1, "comment"="Is this record a Person, not an Opion"}
		 * )
		 */
		private $isPerson = TRUE;
		
		
		/**
		 * @var bool $isWriteIn
		 * @ORM\Column(
		 *     name="is_write_in",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"=0, "comment"="Is this name a Write In"}
		 * )
		 */
		private $isWriteIn = FALSE;
		
		/**
		 * @var bool $shareWriteIn
		 * @ORM\Column(
		 *     name="share_write_in",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"=0, "comment"="Does the voter want to share the name of the write in they have entered?"}
		 * )
		 */
		private $shareWriteIn = FALSE;
		
		public function __construct()
		{
		}
		
		/**
		 * @return string
		 */
		public function __toString():string
		{
			return $this->getDescriptionShort();
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
		 * @return int|null
		 */
		public function getRaceOptionId():?int
		{
			return $this->raceOptionId;
		}
		
		
		/**
		 * @return bool|null
		 */
		public function getIsWriteIn():?bool
		{
			return $this->isWriteIn;
		}
		
		/**
		 * @param  bool  $isWriteIn
		 *
		 * @return RaceOption
		 */
		public function setIsWriteIn(bool $isWriteIn):self
		{
			$this->isWriteIn = $isWriteIn;
			
			return $this;
		}
		
		/**
		 * @return bool|null
		 */
		public function getShareWriteIn():?bool
		{
			return $this->shareWriteIn;
		}
		
		/**
		 * @param  bool  $shareWriteIn
		 *
		 * @return RaceOption
		 */
		public function setShareWriteIn(bool $shareWriteIn):self
		{
			$this->shareWriteIn = $shareWriteIn;
			
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
		 * @return RaceOption
		 */
		public function setRace(?Race $race):self
		{
			$this->race = $race;
			
			return $this;
		}
		
		
		/**
		 * @return Owner|null
		 */
		public function getWriteInByOwner():?Owner
		{
			return $this->writeInByOwner;
		}
		
		/**
		 * @param  Owner|null  $writeInByOwner
		 *
		 * @return RaceOption
		 */
		public function setWriteInByOwner(?Owner $writeInByOwner):self
		{
			$this->writeInByOwner = $writeInByOwner;
			
			return $this;
		}
		
		/**
		 * @return bool|null
		 */
		public function getIsPerson():?bool
		{
			return $this->isPerson;
		}
		
		/**
		 * @param  bool  $isPerson
		 *
		 * @return $this
		 */
		public function setIsPerson(bool $isPerson):self
		{
			$this->isPerson = $isPerson;
			
			return $this;
		}
		
		
	}
