<?php
    
    namespace App\Entity;
    
    use DateTime;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * VoteAuditTrail
     *
     * @ORM\Table(
     *     name="vote_audit_trail",
     *     indexes={
     *          @ORM\Index(name="idx_vote_audit_trail_ballot_id",              columns={"ballot_id"}),
     *          @ORM\Index(name="idx_vote_audit_trail_race_option_id",         columns={"race_option_id"})
     *      }
     * )
     * @ORM\Entity(
     *     repositoryClass="App\Repository\VoteAuditTrailRepository",
     * )
     */
    class VoteAuditTrail
    {
    
        /**
         * @var int
         *
         * @ORM\Column(
         *     name="vote_audit_trail_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for a cast vote audit trails."}
         * )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $voteAuditTrailId;
    
    
        /**
         * @var int $voteId
         *
         * @ORM\Column(
         *     name="vote_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for a cast vote."}
         * )
         */
        private $voteId;
    
        /**
         * @var Ballot|null $ballot
         *
         *
         * @ORM\Column(
         *     name="ballot_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for a cast vote."}
         * )
         *
         *
         */
        private $ballotId;
    
        /**
         * @var RaceOption|null $raceOption
         *
         *
         * @ORM\Column(
         *     name="race_option_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for a cast vote."}
         * )
         *
         */
        private $raceOptionId;
    
    
        /**
         * @var string
         * @ORM\Column(length=45,
         *     nullable=true)
         */
        private $createdFromIp;
    
        /**
         * @var string
         * @ORM\Column(length=45,
         *     nullable=true)
         */
        private $updatedFromIp;
    
        /**
         * @var DateTime
         * @ORM\Column(type="datetime")
         */
        private $createdAt;
    
        /**
         * @var DateTime
         * @ORM\Column(type="datetime")
         */
        private $updatedAt;
    
    
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
         * @return int
         */
        public function getVoteAuditTrailId():int
        {
            return $this->voteAuditTrailId;
        }
    
        /**
         * @param  int  $voteAuditTrailId
         *
         * @return VoteAuditTrail
         */
        public function setVoteAuditTrailId(int $voteAuditTrailId):VoteAuditTrail
        {
            $this->voteAuditTrailId = $voteAuditTrailId;
    
            return $this;
        }
    
        /**
         * @return int
         */
        public function getVoteId():int
        {
            return $this->voteId;
        }
    
        /**
         * @param  int  $voteId
         *
         * @return VoteAuditTrail
         */
        public function setVoteId(int $voteId):VoteAuditTrail
        {
            $this->voteId = $voteId;
    
            return $this;
        }
    
        /**
         * @return Ballot|null
         */
        public function getBallotId():?Ballot
        {
            return $this->ballotId;
        }
    
        /**
         * @param  Ballot|null  $ballotId
         *
         * @return VoteAuditTrail
         */
        public function setBallotId(?Ballot $ballotId):VoteAuditTrail
        {
            $this->ballotId = $ballotId;
    
            return $this;
        }
    
        /**
         * @return RaceOption|null
         */
        public function getRaceOptionId():?RaceOption
        {
            return $this->raceOptionId;
        }
    
        /**
         * @param  RaceOption|null  $raceOptionId
         *
         * @return VoteAuditTrail
         */
        public function setRaceOptionId(?RaceOption $raceOptionId):VoteAuditTrail
        {
            $this->raceOptionId = $raceOptionId;
    
            return $this;
        }
    
        /**
         * @return string
         */
        public function getCreatedFromIp():string
        {
            return $this->createdFromIp;
        }
    
        /**
         * @param  string  $createdFromIp
         *
         * @return VoteAuditTrail
         */
        public function setCreatedFromIp(string $createdFromIp):VoteAuditTrail
        {
            $this->createdFromIp = $createdFromIp;
    
            return $this;
        }
    
        /**
         * @return string
         */
        public function getUpdatedFromIp():string
        {
            return $this->updatedFromIp;
        }
    
        /**
         * @param  string  $updatedFromIp
         *
         * @return VoteAuditTrail
         */
        public function setUpdatedFromIp(string $updatedFromIp):VoteAuditTrail
        {
            $this->updatedFromIp = $updatedFromIp;
    
            return $this;
        }
    
        /**
         * @return DateTime
         */
        public function getCreatedAt():DateTime
        {
            return $this->createdAt;
        }
    
        /**
         * @param  DateTime  $createdAt
         *
         * @return VoteAuditTrail
         */
        public function setCreatedAt(DateTime $createdAt):VoteAuditTrail
        {
            $this->createdAt = $createdAt;
    
            return $this;
        }
    
        /**
         * @return DateTime
         */
        public function getUpdatedAt():DateTime
        {
            return $this->updatedAt;
        }
    
        /**
         * @param  DateTime  $updatedAt
         *
         * @return VoteAuditTrail
         */
        public function setUpdatedAt(DateTime $updatedAt):VoteAuditTrail
        {
            $this->updatedAt = $updatedAt;
    
            return $this;
        }
    
    
    }
