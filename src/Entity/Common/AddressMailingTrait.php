<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait AddressMailingTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait AddressMailingTrait
    {
    
        /**
         * @var string|null $mailingAddressLine1
         * @ORM\Column(
         *     name="mailing_address_line1",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="mailing address line 1"}
         * )
         * @Assert\NotBlank(
         *     message="Line 1 of your Mailing Address is Required.",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         * @Assert\Length(
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Mailing Address is too short. (Minimum of {{ limit }} characters)",
         *     maxMessage="Line 1 of your Mailing Address is too long. (Maximum of {{ limit }} characters)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         * @Assert\Regex(
         *     pattern="/^\d+\s[a-zA-Z0-9\s\.]+/s",
         *     match=false,
         *     message="Please enter only a propper Address in Line 1 of the Mailing Address. (i.e. ##### Street Name Dr.)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         */
        private $mailingAddressLine1;
    
    
        /**
         * @var string|null $mailingAddressLine2
         *
         * @ORM\Column(
         *     name="mailing_address_line2",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="mailing address line 1"}
         * )
         *
         * @Assert\Length(
         *     max="128",
         *     maxMessage="Line 2 of your Mailing Address is too long. (Maximum of {{ Limit }} characters)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         *
         * @Assert\Regex(
         *     pattern="/^[0-9a-zA-Z\s\.\#]+/s",
         *     match=false,
         *     message="Please enter only a propper Address in Line 2 of the Mailing Address.",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         */
        private $mailingAddressLine2;
    
    
        /**
         * @var string|null $mailingAddressCity
         * @ORM\Column(
         *     name="mailing_address_city",
         *     type="string",
         *     length=128,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="mailing address city"}
         * )
         * @Assert\NotBlank(
         *     message="Please enter a Mailing City.",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         * @Assert\Length(
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Mailing Address is too short. (Minimum of {{ Limit }} characters)",
         *     maxMessage="The City of the Mailing Address is too long. (Maximum of {{ Limit }} characters)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         * @Assert\Regex(
         *     pattern="/^[0-9a-zA-Z\s\.\#]+/s",
         *     match=false,
         *     message="Please enter only letters, numbers and spaces the Mailing City.",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         */
        private $mailingAddressCity;
    
    
        /**
         * @var string|null $mailingAddressState
         * @ORM\Column(
         *     name="mailing_address_state",
         *     type="string",
         *     length=2,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="mailing address state"}
         * )
         * @Assert\Length(
         *     max="2",
         *     maxMessage="Please select a Mailing Address State.",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         * @Assert\Regex(
         *     pattern="/^[a-zA-Z]{2}/s",
         *     match=false,
         *     message="Please select a Mailing Address State.",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         */
        private $mailingAddressState;
    
    
        /**
         * @var string|null $mailingAddressZipCode
         * @ORM\Column(
         *     name="mailing_address_zip_code",
         *     type="string",
         *     length=16,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="mailing address zip code"}
         * )
         * @Assert\NotBlank(
         *     message="Please enter a Mailing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         * @Assert\Regex(
         *     pattern="/^[0-9]{5}(-[0-9]{4})?$/s",
         *     match=false,
         *     message="Please enter a Mailing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         */
        private $mailingAddressZipCode;
    
    
        /**
         * @var string|null $mailingAddressCountry
         *
         * @ORM\Column(
         *     name="mailing_address_country",
         *     type="string",
         *     length=2,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="mailing address country code"}
         * )
         *
         * @Assert\Country(
         *     message="Please enter a correct Mailing County Code consisting of Two Letters. (i.e. US or MX)",
         *     groups={"person", "registration", "address", "mailing_address"}
         * )
         */
        private $mailingAddressCountry;
    
    
        /**
         * @return string|null
         */
        public function getMailingAddressLine1():?string
        {
            return $this->mailingAddressLine1;
        }
    
        /**
         * @param  string|null  $mailingAddressLine1
         *
         * @return self
         */
        public function setMailingAddressLine1(?string $mailingAddressLine1):self
        {
            $this->mailingAddressLine1 = $mailingAddressLine1;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getMailingAddressLine2():?string
        {
            return $this->mailingAddressLine2;
        }
    
        /**
         * @param  string|null  $mailingAddressLine2
         *
         * @return self
         */
        public function setMailingAddressLine2(?string $mailingAddressLine2):self
        {
            $this->mailingAddressLine2 = $mailingAddressLine2;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getMailingAddressCity():?string
        {
            return $this->mailingAddressCity;
        }
    
        /**
         * @param  string|null  $mailingAddressCity
         *
         * @return self
         */
        public function setMailingAddressCity(?string $mailingAddressCity):self
        {
            $this->mailingAddressCity = $mailingAddressCity;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getMailingAddressState():?string
        {
            return $this->mailingAddressState;
        }
    
        /**
         * @param  string|null  $mailingAddressState
         *
         * @return self
         */
        public function setMailingAddressState(?string $mailingAddressState):self
        {
            $this->mailingAddressState = $mailingAddressState;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getMailingAddressZipCode():?string
        {
            return $this->mailingAddressZipCode;
        }
    
        /**
         * @param  string|null  $mailingAddressZipCode
         *
         * @return self
         */
        public function setMailingAddressZipCode(?string $mailingAddressZipCode):self
        {
            $this->mailingAddressZipCode = $mailingAddressZipCode;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getMailingAddressCountry():?string
        {
            return $this->mailingAddressCountry;
        }
    
        /**
         * @param  string|null  $mailingAddressCountry
         *
         * @return self
         */
        public function setMailingAddressCountry(?string $mailingAddressCountry):self
        {
            $this->mailingAddressCountry = $mailingAddressCountry;
    
            return $this;
        }
    
    }
