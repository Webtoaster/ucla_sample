<?php
    
    namespace App\Entity\Common;
    
    /**
     * Trait CredentialsTrait
     *
     * @package App\Entity\Common
     */
    trait CredentialsTrait
    {
        
        
        /**
         * @return string|null
         * @see UserInterface
         */
        public function getSalt():?string
        {
            // not needed when using the "bcrypt" algorithm in security.yaml
            return NULL;
        }
        
        
        /**
         * @return string|null
         * @see UserInterface
         */
        public function eraseCredentials():?string
        {
            /*
             * If you store any temporary, sensitive data on the user, clear it here
             * $this->plainPassword;
             */
            
            return NULL;
        }
        
        
    }
