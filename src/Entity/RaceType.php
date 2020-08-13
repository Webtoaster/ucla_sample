<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\DescriptionTrait;
    use App\Entity\Common\SortOrderTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * RaceType
     *
     * @ORM\Table(
     *     name="race_type",
     *     indexes={
     *          @ORM\Index(name="idx_race_type_description_short",              columns={"description_short"}),
     *          @ORM\Index(name="idx_race_type_sort_order",                     columns={"sort_order"}),
     *     }
     *
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\RaceTypeRepository",
     * )
     */
    class RaceType
    {
    
        /**
         * @var int
         *
         * @ORM\Column(
         *     name="race_type_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for Race_Type"})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $raceTypeId;
    
    
        use DescriptionTrait;
        use SortOrderTrait;
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
    
        public function __construct()
        {
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
        public function getRaceTypeId():?int
        {
            return $this->raceTypeId;
        }
    
    
    }
