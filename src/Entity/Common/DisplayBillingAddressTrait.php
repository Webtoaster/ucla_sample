<?php
    
    namespace App\Entity\Common;
    
    /**
     * Trait DisplayBillingAddressTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     *
     */
    trait DisplayBillingAddressTrait
    {
    
        /**
         * @var bool $displayMailingAddress
         *
         * @ORM\Column(
         *     name="display_billing_address",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Display the Billing Address?"})
         */
        private $displayBillingAddress = FALSE;
        
        /**
         * @return bool
         */
        public function isDisplayBillingAddress():bool
        {
            return $this->displayBillingAddress;
        }
    
        /**
         * @param  bool  $displayBillingAddress
         *
         * @return self
         */
        public function setDisplayBillingAddress(bool $displayBillingAddress):self
        {
            $this->displayBillingAddress = $displayBillingAddress;
    
            return $this;
        }
    
    
    }
