<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\AddressPropertyTrait;
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\LegalDescriptionTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * Property
     *
     * @ORM\Table(
     *     name="property",
     *     indexes={
     *          @ORM\Index(name="fk_property_to_association",           columns={"association_id"}),
     *          @ORM\Index(name="idx_property_internal_property_id",     columns={"internal_property_id"}),
     *          @ORM\Index(name="idx_property_external_property_id",     columns={"external_property_id"})
     *      }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\PropertyRepository",
     * )
     *
     */
    class Property
    {
    
        /**
         * @var int $propertyId
         *
         * @ORM\Column(
         *     name="property_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for property"}
         *     )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $propertyId;
    
        /**
         * @var Association|null $association
         *
         * @ORM\ManyToOne(
         *     targetEntity="Association"
         * )
         *
         * @ORM\JoinColumn(
         *     name="association_id",
         *     referencedColumnName="association_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        protected $association;
    
        /**
         * @var string|null $internalPropertyId
         *
         * @ORM\Column(
         *     name="internal_property_id",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Externally Produced Account ID from vendor or Appraisal District."}
         *     )
         */
        private $internalPropertyId;
    
        /**
         * @var string|null $externalPropertyId
         *
         * @ORM\Column(
         *     name="external_property_id",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Internally Produced Account ID from Accounting System of the Association."}
         *     )
         */
        private $externalPropertyId;
    
        use AddressPropertyTrait;
        use LegalDescriptionTrait;
    
        // @formatter:off
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        // @formatter:on
    
        /**
         * Property constructor.
         */
        public function __construct()
        {
        }
    
        /**
         * @return string
         */
        public function __toString()
        {
            $property = implode(
                ' ',
                array_filter(
                    [
                        trim($this->propertyAddressLine1),
                        trim($this->propertyAddressLine2),
                        trim($this->propertyAddressCity),
                        trim($this->propertyAddressState),
                        trim($this->propertyAddressZipCode),
                    ]
                )
            );
    
            return $property;
        }
    
        /**
         * @return int
         */
        public function getPropertyId():int
        {
            return $this->propertyId;
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
         * @return Property
         */
        public function setAssociation(?Association $association):self
        {
            $this->association = $association;
    
            return $this;
        }
    
        /**
         * @return null|string
         */
        public function getInternalPropertyId():?string
        {
            return $this->internalPropertyId;
        }
    
        /**
         * @param  null|string  $internalPropertyId
         *
         * @return Property
         */
        public function setInternalPropertyId(?string $internalPropertyId):self
        {
            $this->internalPropertyId = $internalPropertyId;
    
            return $this;
        }
    
        /**
         * @return null|string
         */
        public function getExternalPropertyId():?string
        {
            return $this->externalPropertyId;
        }
    
        /**
         * @param  null|string  $externalPropertyId
         *
         * @return Property
         */
        public function setExternalPropertyId(?string $externalPropertyId):self
        {
            $this->externalPropertyId = $externalPropertyId;
    
            return $this;
        }
    
    
    }
