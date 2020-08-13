<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait PhoneHomeTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait PhoneHomeTrait
    {
    
        /**
         * @var string|null $phoneHome
         *
         * @ORM\Column(
         *     name="phone_home",
         *     type="string",
         *     length=14,
         *     nullable=true,
         *     options={"fixed"=true}
         *     )
         *
         * @Assert\NotBlank(
         *     groups={"person", "phone_home"},
         *     message="Please enter a Home Phone Number."
         * )
         *
         * @Assert\Length(
         *     groups={"person", "phone_home"},
         *     max = 14,
         *     maxMessage="The Home Phone number cannot be over {{ limit }} characters in length."
         * )
         *
         * @Assert\Regex(
         *     groups={"person", "phone", "phone_home"},
         *     pattern="/\d{3}([ .-])?\d{3}([ .-])?\d{4}|\(\d{3}\)([ ])?\d{3}([.-])?\d{4}|\(\d{3}\)([ ])?\d{3}([ ])?\d{4}|\(\d{3}\)([.-])?\d{3}([.-])?\d{4}|\d{3}([ ])?\d{3}([ .-])?\d{4}/s",
         *     match="true",
         *     message="Please enter a Home Phone Number.  i.e. 713-555-1212"
         * )
         *
         */
        private $phoneHome;
    
    
        /**
         * @return string|null
         */
        public function getPhoneHome():?string
        {
            return $this->phoneHome;
        }
    
        /**
         * @param  string|null  $phoneHome
         *
         * @return $this
         */
        public function setPhoneHome(?string $phoneHome):self
        {
            $this->phoneHome = $phoneHome;
    
            return $this;
        }
    
    }
