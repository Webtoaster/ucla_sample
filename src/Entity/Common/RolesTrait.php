<?php
    
    namespace App\Entity\Common;
    
    use function is_array;
    use function is_int;
    
    /**
     * Trait RolesTrait
     *
     * @package App\Entity\Common
     */
    trait RolesTrait
    {
        
        /**
         * @var array $roles
         *
         * @ORM\Column(
         *     name="roles",
         *     type="json",
         *     length=0,
         *     nullable=true
         * )
         */
        private $roles = [];
        
        
        /**
         * @return array
         * @see UserInterface
         */
        public function getRoles():array
        {
            /*
             * Added the typecasting to tell PHPStorm to that it will not produce a possible fatal error
             */
            $roles = $this->roles;
            
            /**
             * Make sure every user has a ROLE_USER entry in the system.
             */
            $roles[] = 'ROLE_USER';
            
            return array_unique($roles);
        }
        
        
        /**
         * @param  array  $roles
         *
         * @return self
         */
        public function setRoles(array $roles):self
        {
            // Make sure the Array is Unique
            $roles = array_unique($roles);
            
            // Then reindex the array in case something is changed.
            $this->roles = array_values($roles);
            
            return $this;
        }
        
        
        /**
         * Merge the existing roles and the new roles in an array, then assign
         * the unique members back into $this->roles
         *
         * @param  array  $newRoles
         *
         * @return self
         * @deprecated
         */
        public function addRoles(array $newRoles):self
        {
            $this->appendRoles($newRoles);
            
            return $this;
        }
        
        
        /**
         * Merge the existing roles and the new roles in an array, then assign
         * the unique members back into $this->roles
         *
         * @param  array|string  $newRoles
         *
         * @return self
         */
        public function appendRoles($newRoles):self
        {
            $existingRoles = $this->getRoles();
            
            if (is_array($newRoles)) {
                $merged = array_merge($existingRoles, $newRoles);
            } else {
                $merged = array_push($existingRoles, $newRoles);
            }
            
            $this->setRoles($merged);
            
            return $this;
        }
        
        
        /**
         * @param $roles
         *
         * @return self
         */
        public function removeRoles($roles):self
        {
            $currentRoles = $this->getRoles();
            
            if (is_array($roles)) {
                $roles = array_unique($roles);
                foreach ($roles as $role) {
                    $currentRoles = $this->dissectRole(strtoupper(trim($role)), $currentRoles);
                }
            } else {
                $roles        = strtoupper(trim($roles));
                $currentRoles = $this->dissectRole($roles, $currentRoles);
            }
            
            $this->setRoles($currentRoles);
            
            return $this;
        }
        
        
        /**
         * @param  string  $role
         *
         * @param  array   $roles
         *
         * @return self
         */
        private function dissectRole(string $role, array $roles):self
        {
            $roles = array_unique($roles);
            
            $role = strtoupper($role);
	
	        $key = array_search($role, $roles, TRUE);
            
            if ($key !== FALSE && is_int($key)) {
                unset($roles[$key]);
            }
            
            return $roles;
        }
        
        
    }
