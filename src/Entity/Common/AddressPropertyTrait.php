<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait AddressPropertyTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait AddressPropertyTrait
    {
    
        /**
         * @var string|null $propertyAddressLine1
         * @Assert\NotBlank(
         *     groups={"company", "property_address"},
         *     message="Line 1 of your Property Address is Required."
         * )
         * @Assert\Length(
         *     groups={"company", "property_address"},
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Property Address is too short. (Minimum of 8 characters)",
         *     maxMessage="Line 1 of your Property Address is too long. (Maximum of {{ limit }} characters)",
         * )
         * @Assert\Regex(
         *     groups={"company", "property_address"},
         *     pattern="/^[a-zA-Z0-9\s.\-_,]+$/",
         *     match=false,
         *     message="Only enter letters, numbers and spaces in Line 1 of the Property Address."
         * )
         * @ORM\Column(
         *     name="property_address_line1",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Property Address line 1"}
         * )
         */
        private $propertyAddressLine1;
    
        /**
         * @var string|null $propertyAddressLine2
         *
         * @Assert\Length(
         *     groups={"company", "property_address"},
         *     max="128",
         *     maxMessage="Line 2 of your Property Address is too long. (Maximum of {{ limit }} characters)",
         * )
         * @ORM\Column(
         *     name="property_address_line2",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Property Address line 1"}
         * )
         */
        private $propertyAddressLine2;
    
        /**
         * @var string|null $propertyAddressCity
         * @Assert\NotBlank(
         *     groups={"company", "property_address"},
         *     message=""
         * )
         * @Assert\Length(
         *     groups={"company", "property_address"},
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Property Address is too short. (Minimum of 2 characters)",
         *     maxMessage="The City of the Property Address is too long. (Maximum of {{ limit }} characters)",
         * )
         * @ORM\Column(
         *     name="property_address_city",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Property Address city"}
         * )
         */
        private $propertyAddressCity;
    
    
        /**
         * @var string|null $propertyAddressState
         * @Assert\NotBlank(
         *     groups={"company", "property_address"},
         *     message="Please select a Property Address State."
         * )
         * @Assert\Length(
         *     groups={"company", "property_address"},
         *     min="2",
         *     max="2",
         *     minMessage="Please select a Property Address State.",
         *     maxMessage="Please select a Property Address State."
         * )
         * @ORM\Column(
         *     name="property_address_state",
         *     type="string",
         *     length=2,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Property Address state"}
         * )
         */
        private $propertyAddressState;
    
    
        /**
         * @var string|null $propertyAddressZipCode
         * @Assert\NotBlank(
         *     groups={"company", "property_address"},
         *     message="Please enter a Property Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         * @ORM\Column(
         *     name="property_address_zip_code",
         *     type="string",
         *     length=16,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Property Address zip code"}
         * )
         */
        private $propertyAddressZipCode;
    
    
        /**
         * @return string|null
         */
        public function getPropertyAddressLine2():?string
        {
            return $this->propertyAddressLine2;
        }
    
        /**
         * @param  string|null  $propertyAddressLine2
         *
         * @return $this
         */
        public function setPropertyAddressLine2(?string $propertyAddressLine2):self
        {
            $this->propertyAddressLine2 = $propertyAddressLine2;
    
            return $this;
        }
    
    
        /**
         * @return string|null
         */
        public function getPropertyAddressCity():?string
        {
            return $this->propertyAddressCity;
        }
    
        /**
         * @param  string  $propertyAddressCity
         *
         * @return $this
         */
        public function setPropertyAddressCity(string $propertyAddressCity):self
        {
            $this->propertyAddressCity = $propertyAddressCity;
    
            return $this;
        }
    
    
        /**
         * @return string|null
         */
        public function getPropertyAddressState():?string
        {
            return $this->propertyAddressState;
        }
    
        /**
         * @param  string  $propertyAddressState
         *
         * @return $this
         */
        public function setPropertyAddressState(string $propertyAddressState):self
        {
            $this->propertyAddressState = $propertyAddressState;
    
            return $this;
        }
    
    
        /**
         * @return string|null
         */
        public function getPropertyAddressZipCode():?string
        {
            return $this->propertyAddressZipCode;
        }
    
        /**
         * @param  string  $propertyAddressZipCode
         *
         * @return $this
         */
        public function setPropertyAddressZipCode(string $propertyAddressZipCode):self
        {
            $this->propertyAddressZipCode = $propertyAddressZipCode;
    
            return $this;
        }
    
    
        /**
         * @return string|null
         */
        public function getPropertyAddressLine1():?string
        {
            return $this->propertyAddressLine1;
        }
    
        /**
         * @param  string  $propertyAddressLine1
         *
         * @return $this
         */
        public function setPropertyAddressLine1(string $propertyAddressLine1):self
        {
            $this->propertyAddressLine1 = $propertyAddressLine1;
    
            return $this;
        }
    
    }
