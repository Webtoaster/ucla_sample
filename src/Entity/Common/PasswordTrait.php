<?php
    
    namespace App\Entity\Common;
    
    use DateTime;
    use DateTimeInterface;
    
    /**
     * Trait PasswordTrait
     *
     * @package App\Entity\Common
     */
    trait PasswordTrait
    {
        
        
        /**
         * The Password field is Nullable because this table can hold mere contact information based on
         * its purpose is to carry information about persons.
         * Be sure to use FORM LEVEL validation for this field with a Form Class implementation of
         * of validation or via Form Model Assertion or Ultimately a Password Validation Callback.
         *
         * @var string|null $password
         * @ORM\Column(
         *     name="pw",
         *     type="string",
         *     length=255,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Password for the UserInterface Login.  Note the SQL name is pw."}
         * )
         */
        private $plainPassword;
        
        
        /**
         * @var string|null $passwordRecoveryKey
         *
         * @ORM\Column(
         *     name="password_recovery_key",
         *     type="string",
         *     length=32,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="Key to be included in the verification email"},
         * )
         */
        private $passwordRecoveryKey;
        
        /**
         * @var DateTime|null $passwordRecoveryDate
         *
         * @ORM\Column(
         *     name="password_recovery_date",
         *     type="datetime",
         *     nullable=true,
         *     options={"comment"="Date password recovery was made."}
         * )
         */
        private $passwordRecoveryDate;
        
        /**
         * @var string|null $passwordRecoveryIpAddress
         *
         * @ORM\Column(
         *     name="password_recovery_ip_address",
         *     type="string",
         *     length=39,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="IP Address where the password request was made."}
         * )
         */
        private $passwordRecoveryIpAddress;
        
        
        /**
         * @return string|null
         * @see UserInterface
         */
        public function getPassword():?string
        {
            return $this->plainPassword;
        }
        
        /**
         * @param  string  $plainPassword
         *
         * @return self
         */
        public function setPassword(string $plainPassword):self
        {
            $this->plainPassword = $plainPassword;
            
            return $this;
        }
        
        /**
         * @return string|null
         *
         */
        public function getPlainPassword():?string
        {
            return $this->plainPassword;
        }
        
        
        /**
         * @param  string  $plainPassword
         *
         * @return self
         */
        public function setPlainPassword(string $plainPassword):self
        {
            $this->plainPassword = $plainPassword;
            
            return $this;
        }
        
        
        /**
         * @return string|null
         */
        public function getPasswordRecoveryKey():?string
        {
            return $this->passwordRecoveryKey;
        }
        
        /**
         * @param  string|null  $passwordRecoveryKey
         *
         * @return self
         */
        public function setPasswordRecoveryKey(?string $passwordRecoveryKey):self
        {
            $this->passwordRecoveryKey = $passwordRecoveryKey;
            
            return $this;
        }
        
        /**
         * @return DateTimeInterface|null
         */
        public function getPasswordRecoveryDate():?DateTimeInterface
        {
            return $this->passwordRecoveryDate;
        }
        
        /**
         * @param  DateTimeInterface|null  $passwordRecoveryDate
         *
         * @return self
         */
        public function setPasswordRecoveryDate(?DateTimeInterface $passwordRecoveryDate):self
        {
            $this->passwordRecoveryDate = $passwordRecoveryDate;
            
            return $this;
        }
        
        /**
         * @return string|null
         */
        public function getPasswordRecoveryIpAddress():?string
        {
            return $this->passwordRecoveryIpAddress;
        }
        
        /**
         * @param  string|null  $passwordRecoveryIpAddress
         *
         * @return self
         */
        public function setPasswordRecoveryIpAddress(?string $passwordRecoveryIpAddress):self
        {
            $this->passwordRecoveryIpAddress = $passwordRecoveryIpAddress;
            
            return $this;
        }
        
        
    }
