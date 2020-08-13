<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait AddressPhysicalTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait AddressPhysicalTrait
    {
    
        /**
         * @var string|null $physicalAddressLine1
         * @ORM\Column(
         *     name="physical_address_line1",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="physical address line 1"}
         * )
         * @Assert\NotBlank(
         *     message="Line 1 of your Physical Address is Required.",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         * @Assert\Length(
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Physical Address is too short. (Minimum of {{ limit }} characters)",
         *     maxMessage="Line 1 of your Physical Address is too long. (Maximum of {{ limit }} characters)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         * @Assert\Regex(
         *     pattern="/^\d+\s[a-zA-Z0-9\s\.]+/s",
         *     match=false,
         *     message="Please enter only a propper Address in Line 1 of the Physical Address. (i.e. ##### Street Name Dr.)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         */
        private $physicalAddressLine1;
    
        /**
         * @var string|null $physicalAddressLine2
         *
         * @ORM\Column(
         *     name="physical_address_line2",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="physical address line 1"}
         * )
         *
         * @Assert\Length(
         *     max="128",
         *     maxMessage="Line 2 of your Physical Address is too long. (Maximum of {{ Limit }} characters)",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         *
         * @Assert\Regex(
         *     pattern="/^[0-9a-zA-Z\s\.\#]+/s",
         *     match=false,
         *     message="Please enter only a propper Address in Line 2 of the Physical Address.",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         */
        private $physicalAddressLine2;
    
        /**
         * @var string|null $physicalAddressCity
         * @ORM\Column(
         *     name="physical_address_city",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="physical address city"}
         * )
         * @Assert\NotBlank(
         *     message="Please enter a Physical City.",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         * @Assert\Length(
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Physical Address is too short. (Minimum of {{ Limit }} characters)",
         *     maxMessage="The City of the Physical Address is too long. (Maximum of {{ Limit }} characters)",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         * @Assert\Regex(
         *     pattern="/^[0-9a-zA-Z\s\.\#]+/s",
         *     match=false,
         *     message="Please enter only letters, numbers and spaces the Physical City.",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         */
        private $physicalAddressCity;
    
        /**
         * @var string|null $physicalAddressState
         * @ORM\Column(
         *     name="physical_address_state",
         *     type="string",
         *     length=2,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="physical address state"}
         * )
         * @Assert\Length(
         *     max="2",
         *     maxMessage="Please select a Physical Address State.",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         * @Assert\Regex(
         *     pattern="/^[a-zA-Z]{2}/s",
         *     match=false,
         *     message="Please select a Physical Address State.",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         */
        private $physicalAddressState;
    
        /**
         * @var string|null $physicalAddressZipCode
         * @ORM\Column(
         *     name="physical_address_zip_code",
         *     type="string",
         *     length=16,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="physical address zip code"}
         * )
         * @Assert\NotBlank(
         *     message="Please enter a Physical Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         * @Assert\Regex(
         *     pattern="/^[0-9]{5}(-[0-9]{4})?$/s",
         *     match=false,
         *     message="Please enter a Physical Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)",
         *     groups={"person", "registration", "address", "physical_address"}
         * )
         */
        private $physicalAddressZipCode;
    
        /**
         * @return string|null
         */
        public function getPhysicalAddressLine1():?string
        {
            return $this->physicalAddressLine1;
        }
    
        /**
         * @param  string|null  $physicalAddressLine1
         *
         * @return $this
         */
        public function setPhysicalAddressLine1(?string $physicalAddressLine1):self
        {
            $this->physicalAddressLine1 = $physicalAddressLine1;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getPhysicalAddressLine2():?string
        {
            return $this->physicalAddressLine2;
        }
    
        /**
         * @param  string|null  $physicalAddressLine2
         *
         * @return $this
         */
        public function setPhysicalAddressLine2(?string $physicalAddressLine2):self
        {
            $this->physicalAddressLine2 = $physicalAddressLine2;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getPhysicalAddressCity():?string
        {
            return $this->physicalAddressCity;
        }
    
        /**
         * @param  string|null  $physicalAddressCity
         *
         * @return $this
         */
        public function setPhysicalAddressCity(?string $physicalAddressCity):self
        {
            $this->physicalAddressCity = $physicalAddressCity;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getPhysicalAddressState():?string
        {
            return $this->physicalAddressState;
        }
    
        /**
         * @param  string|null  $physicalAddressState
         *
         * @return $this
         */
        public function setPhysicalAddressState(?string $physicalAddressState):self
        {
            $this->physicalAddressState = $physicalAddressState;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getPhysicalAddressZipCode():?string
        {
            return $this->physicalAddressZipCode;
        }
    
        /**
         * @param  string|null  $physicalAddressZipCode
         *
         * @return $this
         */
        public function setPhysicalAddressZipCode(?string $physicalAddressZipCode):self
        {
            $this->physicalAddressZipCode = $physicalAddressZipCode;
    
            return $this;
        }
    
    }
