<?php
    
    namespace App\Entity\Common;
    
    /**
     * Trait SortOrderTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait SortOrderTrait
    {
    
        /**
         * @var int $sortOrder
         *
         * @ORM\Column(
         *     name="sort_order",
         *     type="integer",
         *     nullable=true,
         *     options={"default"=100000, "unsigned"=true,"comment"="Order of Display"}
         * )
         */
        private $sortOrder = 100000;
    
        /**
         * @return int
         */
        public function getSortOrder():int
        {
            return $this->sortOrder;
        }
    
        /**
         * @param  int  $sortOrder
         *
         * @return self
         */
        public function setSortOrder(int $sortOrder):self
        {
            $this->sortOrder = $sortOrder;
    
            return $this;
        }
    
    
    }
