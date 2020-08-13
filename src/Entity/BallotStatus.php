<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\DescriptionTrait;
    use App\Entity\Common\SortOrderTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * @ORM\Table(
     *     name="ballot_status"
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\BallotStatusRepository"
     * )
     */
    class BallotStatus
    {
    
        /**
         * @var int $ballotStatusId
         *
         * @ORM\Column(
         *     name="ballot_status_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for Ballot Status"}
         * )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $ballotStatusId;
    
        use DescriptionTrait;
    
        use SortOrderTrait;
    
        // @formatter:off
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        // @formatter:on
    
    
        /**
         * ProxyStatus constructor.
         *
         */
        public function __construct()
        {
            // $this->ballotStatusId = $ballotStatusId;
        }
    
        /**
         * @return string
         */
        public function __toString()
        {
            return $this->getDescriptionShort();
        }
    
    
        /**
         * @return int|null
         */
        public function getBallotStatusId():?int
        {
            return $this->ballotStatusId;
        }
    
    
    }
