<?php
    
    namespace App\Entity\Common;
    
    /**
     * Trait DisplayMailingAddressTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     *
     */
    trait DisplayMailingAddressTrait
    {
    
    
        /**
         * @var bool $displayMailingAddress
         *
         * @ORM\Column(
         *     name="display_mailing_address",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Display the Mailing Address?"})
         */
        private $displayMailingAddress = FALSE;
        
        /**
         * @return bool
         */
        public function isDisplayMailingAddress():bool
        {
            return $this->displayMailingAddress;
        }
    
        /**
         * @param  bool  $displayMailingAddress
         *
         * @return self
         */
        public function setDisplayMailingAddress(bool $displayMailingAddress):self
        {
            $this->displayMailingAddress = $displayMailingAddress;
    
            return $this;
        }
    
    
    }
