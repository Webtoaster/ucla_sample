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
     *     name="display_method"
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\DisplayMethodRepository",
     * )
     */
    class DisplayMethod
    {
    
        /**
         * @var int
         *
         * @ORM\Column(
         *     name="display_method_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for DisplayMethod"})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $displayMethodId;
    
    
        use DescriptionTrait;
    
        use SortOrderTrait;
    
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
    
    
        /**
         * DisplayMethod constructor.
         */
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
    
    
        /**
         * @return int|null
         */
        public function getDisplayMethodId():?int
        {
            return $this->displayMethodId;
        }
    
    
    }
