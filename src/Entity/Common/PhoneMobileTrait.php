<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait PhoneMobileTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait PhoneMobileTrait
    {
    
    
        /**
         * @var string|null $phoneMobile
         *
         * @ORM\Column(
         *     name="phone_mobile",
         *     type="string",
         *     length=14,
         *     nullable=true,
         *     options={"fixed"="true"}
         *     )
         *
         * @Assert\NotBlank(
         *     groups={"person", "phone_mobile"},
         *     message="Please enter a Mobile Phone Number."
         * )
         *
         * @Assert\Length(
         *     groups={"person", "phone_mobile"},
         *     max = 14,
         *     maxMessage="The Mobile Phone number cannot be over {{ limit }} characters in length."
         * )
         *
         * @Assert\Regex(
         *     groups={"person", "phone", "phone_mobile"},
         *     pattern="/\d{3}([ .-])?\d{3}([ .-])?\d{4}|\(\d{3}\)([ ])?\d{3}([.-])?\d{4}|\(\d{3}\)([ ])?\d{3}([ ])?\d{4}|\(\d{3}\)([.-])?\d{3}([.-])?\d{4}|\d{3}([ ])?\d{3}([ .-])?\d{4}/s",
         *     match="true",
         *     message="Please enter a Mobile Phone Number.  i.e. 713-555-1212"
         * )
         */
        private $phoneMobile;
    
        /**
         * @return string|null
         */
        public function getPhoneMobile():?string
        {
            return $this->phoneMobile;
        }
    
        /**
         * @param  string|null  $phoneMobile
         *
         * @return self
         */
        public function setPhoneMobile(?string $phoneMobile):self
        {
            $this->phoneMobile = $phoneMobile;
    
            return $this;
        }
    
    }
