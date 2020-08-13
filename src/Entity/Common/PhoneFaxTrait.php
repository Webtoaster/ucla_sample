<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait PhoneFaxTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait PhoneFaxTrait
    {
    
        /**
         * @var string|null $phoneFax
         *
         * @ORM\Column(
         *     name="phone_fax",
         *     type="string",
         *     length=14,
         *     nullable=true,
         *     options={"fixed"=true}
         *     )
         *
         * @Assert\NotBlank(
         *     groups={"person", "phone", "phone_fax"},
         *     message="Please enter a Facsimile Phone Number."
         * )
         *
         * @Assert\Length(
         *     groups={"person", "phone", "phone_fax"},
         *     max = 14,
         *     maxMessage="The Facsimile Phone number cannot be over {{ limit }} characters in length."
         * )
         *
         * @Assert\Regex(
         *     groups={"person", "phone", "phone_fax"},
         *     pattern="/\d{3}([ .-])?\d{3}([ .-])?\d{4}|\(\d{3}\)([ ])?\d{3}([.-])?\d{4}|\(\d{3}\)([ ])?\d{3}([ ])?\d{4}|\(\d{3}\)([.-])?\d{3}([.-])?\d{4}|\d{3}([ ])?\d{3}([ .-])?\d{4}/s",
         *     match="true",
         *     message="Please enter a Facsimile Phone Number.  i.e. 713-555-1212"
         * )
         *
         */
        private $phoneFax;
    
        /**
         * @return string|null
         */
        public function getPhoneFax():?string
        {
            return $this->phoneFax;
        }
    
        /**
         * @param  string|null  $phoneFax
         *
         * @return $this
         */
        public function setPhoneFax(?string $phoneFax):self
        {
            $this->phoneFax = $phoneFax;
    
            return $this;
        }
    
    }
