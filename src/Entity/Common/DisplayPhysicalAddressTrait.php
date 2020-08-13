<?php
    
    namespace App\Entity\Common;
    
    /**
     * Trait DisplayPhysicalAddressTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     *
     */
    trait DisplayPhysicalAddressTrait
    {
    
    
        /**
         * @var bool $displayPhysicalAddress
         *
         * @ORM\Column(
         *     name="display_physical_address",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Display the Physical Address?"})
         */
        private $displayPhysicalAddress = FALSE;
        
        /**
         * @return bool
         */
        public function isDisplayPhysicalAddress():bool
        {
            return $this->displayPhysicalAddress;
        }
    
        /**
         * @param  bool  $displayPhysicalAddress
         *
         * @return self
         */
        public function setDisplayPhysicalAddress(bool $displayPhysicalAddress):self
        {
            $this->displayPhysicalAddress = $displayPhysicalAddress;
    
            return $this;
        }
    
    
    }
