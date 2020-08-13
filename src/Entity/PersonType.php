<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\DescriptionTrait;
    use App\Entity\Common\SortOrderTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    
    /**
     * PersonType
     *
     * @ORM\Table(
     *     name="person_type",
     *     indexes={
     *          @ORM\Index(name="idx_race_type_description_short",              columns={"description_short"}),
     *          @ORM\Index(name="idx_race_type_sort_order",                     columns={"sort_order"}),
     *     }
     * )
     * @ORM\Entity(
     *     repositoryClass="App\Repository\PersonTypeRepository"
     * )
     */
    class PersonType
    {
    
        /**
         * @var int
         *
         * @ORM\Column(
         *     name="person_type_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key to Person_Type"}
         *     )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $personTypeId;
    
    
        use DescriptionTrait;
        use SortOrderTrait;
    
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
    
    
        /**
         * PersonType constructor.
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
         * @return null|int
         */
        public function getPersonTypeId():?int
        {
            return $this->personTypeId;
        }
    
    
    }
