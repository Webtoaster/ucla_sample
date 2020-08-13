<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait PhoneWork
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait PhoneWorkTrait
    {
    
        /**
         * @var string|null $phoneWork
         *
         * @ORM\Column(
         *     name="phone_work",
         *     type="string",
         *     length=14,
         *     nullable=true,
         *     options={"fixed"=true}
         *     )
         *
         * @Assert\NotBlank(
         *     groups={"person", "phone_work"},
         *     message="Please enter a Work Phone Number."
         * )
         *
         * @Assert\Length(
         *     groups={"person", "phone_work"},
         *     max = 14,
         *     maxMessage="The Work Phone number cannot be over {{ limit }} characters in length."
         * )
         *
         * @Assert\Regex(
         *     groups={"person", "phone", "phone_work"},
         *     pattern="/\d{3}([ .-])?\d{3}([ .-])?\d{4}|\(\d{3}\)([ ])?\d{3}([.-])?\d{4}|\(\d{3}\)([ ])?\d{3}([ ])?\d{4}|\(\d{3}\)([.-])?\d{3}([.-])?\d{4}|\d{3}([ ])?\d{3}([ .-])?\d{4}/s",
         *     match="true",
         *     message="Please enter a Work Phone Number.  i.e. 713-555-1212"
         * )
         *
         */
        private $phoneWork;
    
        /**
         * @return string|null
         */
        public function getPhoneWork():?string
        {
            return $this->phoneWork;
        }
    
        /**
         * @param  string|null  $phoneWork
         *
         * @return $this
         */
        public function setPhoneWork(?string $phoneWork):self
        {
            $this->phoneWork = $phoneWork;
    
            return $this;
        }
    
    }
