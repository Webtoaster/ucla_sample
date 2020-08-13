<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\DescriptionTrait;
    use App\Entity\Common\SortOrderTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    
    /**
     * RelationshipType
     *
     * @ORM\Table(
     *     name="relationship_type",
     *     indexes={
     *          @ORM\Index(name="idx_relationship_type_description_short",              columns={"description_short"}),
     *          @ORM\Index(name="idx_relationship_type_sort_order",                     columns={"sort_order"}),
     *     }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\RelationshipTypeRepository",
     * )
     */
    class RelationshipType
    {
        
        /**
         * @var int
         *
         * @ORM\Column(
         *     name="relationship_type_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for Relationship_Type"})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $relationshipTypeId;
        
        
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
	    public function __toString():string
	    {
		    return $this->getDescriptionShort();
	    }
	
	    /**
         * @return int
         */
        public function getRelationshipTypeId():int
        {
            return $this->relationshipTypeId;
        }
        
        /**
         * @param  int  $relationshipTypeId
         *
         * @return RelationshipType
         */
        public function setRelationshipTypeId(int $relationshipTypeId):self
        {
            $this->relationshipTypeId = $relationshipTypeId;
            
            return $this;
        }
	
	
    }
