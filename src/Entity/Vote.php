<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * Vote
     *
     * @ORM\Table(
     *     name="vote",
     *     indexes={
     *          @ORM\Index(name="idx_vote_race_option_id",                            columns={"race_option_id"}),
     *          @ORM\Index(name="idx_vote_ballot_id",                                 columns={"ballot_id"})
     *      }
     * )
     * @ORM\Entity(
     *     repositoryClass="App\Repository\VoteRepository",
     * )
     */
    class Vote
    {
    
        /**
         * @var int
         *
         * @ORM\Column(
         *     name="vote_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for a cast vote."}
         * )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $voteId;
    
        /**
         * @var Ballot|null $ballot
         *
         * @ORM\ManyToOne(
         *     targetEntity="Ballot"
         * )
         *
         * @ORM\JoinColumn(
         *     name="ballot_id",
         *     referencedColumnName="ballot_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        protected $ballot;
    
        /**
         * @var RaceOption $raceOption
         *
         * @ORM\ManyToOne(
         *     targetEntity="RaceOption"
         * )
         * @ORM\JoinColumn(
         *     name="race_option_id",
         *     referencedColumnName="race_option_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        protected $raceOption;
    
    
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
    
    
        /**
         * Vote constructor.
         */
        public function __construct()
        {
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
        public function getVoteId():?int
        {
            return $this->voteId;
        }
    
    
        /**
         * @return Ballot|null
         */
        public function getBallot():?Ballot
        {
            return $this->ballot;
        }
    
        /**
         * @param  Ballot|null  $ballot
         *
         * @return Vote
         */
        public function setBallot(?Ballot $ballot):self
        {
            $this->ballot = $ballot;
    
            return $this;
        }
    
    
        /**
         * @return RaceOption|null
         */
        public function getRaceOption():?RaceOption
        {
            return $this->raceOption;
        }
    
        /**
         * @param  RaceOption|null  $raceOption
         *
         * @return Vote
         */
        public function setRaceOption(?RaceOption $raceOption):self
        {
            $this->raceOption = $raceOption;
    
            return $this;
        }
    
    
    }
