<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait AddressEmailTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait AddressEmailTrait
    {
    
        /**
         * @var string|null $email
         *
         * @Assert\Email(
         *     message="The Email Address is not valid.",
         *     groups={"person", "registration", "email", "email_person", "email_candidate"}
         * )
         *
         * @Assert\Email(
         *     mode = "html5",
         *     message = "The email address, '{{ value }}', is not a valid.",
         *     groups={"person", "registration", "email"}
         *     )
         *
         * You can also use the strict email validation since the egulias/email-validator is installed.
         *
         * @Assert\NotBlank(
         *     message="The Email Address cannot be empty or blank.",
         *     groups={"person", "registration", "email"}
         * )
         *
         * @Assert\Unique(
         *     message="There is already an account with this Email Address.",
         *     groups={"xxx"}
         * )
         *
         * @ORM\Column(
         *     name="email",
         *     type="string",
         *     length=180,
         *     nullable=true
         * )
         */
        private $email;
    
        /**
         * @return null|string
         */
        public function getEmail():?string
        {
            return $this->email;
        }
    
        /**
         * @param  string  $email
         *
         * @return $this
         */
        public function setEmail(string $email):self
        {
            $this->email = $email;
    
            return $this;
        }
    
    }
