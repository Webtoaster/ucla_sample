<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;
    
    /**
     * Trait UsernameUniqueTrait
     *
     * Note that Uniqueness will be driven from the email input for the time being.
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait UsernameUniqueTrait
    {
        
        //
        // * @Assert\Unique(
        // *     message="There is already an account with this un Address.",
        // *     groups={"person", "registration", "un"}
        // * )
        //
        
        /**
         * @var string|null $un
         *
         * @Assert\NotBlank(
         *     message="The Username cannot be empty or blank.",
         *     groups={"un"}
         * )
         *
         * @ORM\Column(
         *     name="un",
         *     type="string",
         *     length=180,
         *     nullable=true,
         *     unique=true
         * )
         */
        private $un;
        
        /**
         * @return null|string
         */
        public function getUn():?string
        {
            return $this->un;
        }
        
        /**
         * @param  string  $un
         *
         * @return self
         */
        public function setUn(string $un):self
        {
            $this->un = $un;
            
            return $this;
        }
    
    
    }
