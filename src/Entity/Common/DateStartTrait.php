<?php
    
    namespace App\Entity\Common;
    
    use DateTime;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait DateStartTrait
     *
     * @package App\Entity\Common
     */
    trait DateStartTrait
    {
    
    
        /**
         * @var DateTime|null $dateStart
         *
         * @Assert\NotBlank(
         *     allowNull=false,
         *     groups={"requireStartDate"},
         *     message="Please enter a Starting Date."
         * )
         *
         * @Assert\GreaterThan(
         *     value="today UTC",
         *     message="Please enter a Date that occurs on or after today.",
         *     groups={"requireStartDate"}
         *
         * )
         *
         * @ORM\Column(
         *     name="date_start",
         *     type="datetime",
         *     nullable=true,
         *     options={"comment"="Starting Date"}
         *     )
         */
        private $dateStart;
    
        /**
         * @return DateTime|null
         */
        public function getDateStart():?DateTime
        {
            return $this->dateStart;
        }
    
        /**
         * @param  DateTime|null  $dateStart
         *
         * @return self
         */
        public function setDateStart(?DateTime $dateStart):self
        {
            $this->dateStart = $dateStart;
    
            return $this;
        }
    
    
    }
