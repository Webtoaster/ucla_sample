<?php
    
    namespace App\Entity\Common;
    
    /**
     * Trait BooleanIsActiveTrait
     *
     * @package App\Entity\Common
     */
    trait BooleanIsActiveTrait
    {
    
        /**
         * @var bool $isActive
         *
         * @ORM\Column(
         *     name="is_active",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=1, "comment"="Is record active"}
         *     )
         */
        private $isActive = TRUE;
        
        /**
         * @return bool
         */
        public function getIsActive():bool
        {
            return $this->isActive;
        }
    
        /**
         * @param  bool  $isActive
         *
         * @return $this
         */
        public function setIsActive(bool $isActive):self
        {
            $this->isActive = $isActive;
    
            return $this;
        }
    
    }
