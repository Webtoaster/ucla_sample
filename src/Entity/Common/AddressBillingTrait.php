<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait AddressBillingTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait AddressBillingTrait
    {
    
        /**
         * @var string|null $billingAddressLine1
         * @Assert\NotBlank(
         *     groups={"company", "billing_address"},
         *     message="Line 1 of your Billing Address is Required."
         * )
         * @Assert\Length(
         *     groups={"company", "billing_address"},
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Billing Address is too short. (Minimum of 8 characters)",
         *     maxMessage="Line 1 of your Billing Address is too long. (Maximum of {{ limit }} characters)",
         * )
         * @Assert\Regex(
         *     groups={"company", "billing_address"},
         *     pattern="/^[a-zA-Z0-9\s.\-_,]+$/",
         *     match=false,
         *     message="Only enter letters, numbers and spaces in Line 1 of the Billing Address."
         * )
         * @ORM\Column(
         *     name="billing_address_line1",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Billing Address line 1"}
         * )
         */
        private $billingAddressLine1;
    
        /**
         * @var string|null $billingAddressLine2
         *
         * @Assert\Length(
         *     groups={"company", "billing_address"},
         *     max="128",
         *     maxMessage="Line 2 of your Billing Address is too long. (Maximum of {{ limit }} characters)",
         * )
         * @ORM\Column(
         *     name="billing_address_line2",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Billing Address line 1"}
         * )
         */
        private $billingAddressLine2;
    
        /**
         * @var string|null $billingAddressCity
         * @Assert\NotBlank(
         *     groups={"company", "billing_address"},
         *     message=""
         * )
         * @Assert\Length(
         *     groups={"company", "billing_address"},
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Billing Address is too short. (Minimum of 2 characters)",
         *     maxMessage="The City of the Billing Address is too long. (Maximum of {{ limit }} characters)",
         * )
         * @ORM\Column(
         *     name="billing_address_city",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Billing Address city"}
         * )
         */
        private $billingAddressCity;
    
    
        /**
         * @var string|null $billingAddressState
         * @Assert\NotBlank(
         *     groups={"company", "billing_address"},
         *     message="Please select a Billing Address State."
         * )
         * @Assert\Length(
         *     groups={"company", "billing_address"},
         *     min="2",
         *     max="2",
         *     minMessage="Please select a Billing Address State.",
         *     maxMessage="Please select a Billing Address State."
         * )
         * @ORM\Column(
         *     name="billing_address_state",
         *     type="string",
         *     length=2,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Billing Address state"}
         * )
         */
        private $billingAddressState;
    
    
        /**
         * @var string|null $billingAddressZipCode
         * @Assert\NotBlank(
         *     groups={"company", "billing_address"},
         *     message="Please enter a Billing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         * @ORM\Column(
         *     name="billing_address_zip_code",
         *     type="string",
         *     length=16,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Billing Address zip code"}
         * )
         */
        private $billingAddressZipCode;
    
    
        /**
         * @return string|null
         */
        public function getBillingAddressLine2():?string
        {
            return $this->billingAddressLine2;
        }
    
        /**
         * @param  string|null  $billingAddressLine2
         *
         * @return $this
         */
        public function setBillingAddressLine2(?string $billingAddressLine2):self
        {
            $this->billingAddressLine2 = $billingAddressLine2;
    
            return $this;
        }
    
    
        /**
         * @return string|null
         */
        public function getBillingAddressCity():?string
        {
            return $this->billingAddressCity;
        }
    
        /**
         * @param  string  $billingAddressCity
         *
         * @return $this
         */
        public function setBillingAddressCity(string $billingAddressCity):self
        {
            $this->billingAddressCity = $billingAddressCity;
    
            return $this;
        }
    
    
        /**
         * @return string|null
         */
        public function getBillingAddressState():?string
        {
            return $this->billingAddressState;
        }
    
        /**
         * @param  string  $billingAddressState
         *
         * @return $this
         */
        public function setBillingAddressState(string $billingAddressState):self
        {
            $this->billingAddressState = $billingAddressState;
    
            return $this;
        }
    
    
        /**
         * @return string|null
         */
        public function getBillingAddressZipCode():?string
        {
            return $this->billingAddressZipCode;
        }
    
        /**
         * @param  string  $billingAddressZipCode
         *
         * @return $this
         */
        public function setBillingAddressZipCode(string $billingAddressZipCode):self
        {
            $this->billingAddressZipCode = $billingAddressZipCode;
    
            return $this;
        }
    
    
        /**
         * @return string|null
         */
        public function getBillingAddressLine1():?string
        {
            return $this->billingAddressLine1;
        }
    
        /**
         * @param  string  $billingAddressLine1
         *
         * @return $this
         */
        public function setBillingAddressLine1(string $billingAddressLine1):self
        {
            $this->billingAddressLine1 = $billingAddressLine1;
    
            return $this;
        }
    
    }
