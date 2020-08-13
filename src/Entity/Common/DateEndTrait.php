<?php
    
    namespace App\Entity\Common;
    
    use DateTime;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait DateEndTrait
     *
     * @package App\Entity\Common
     */
    trait DateEndTrait
    {
    
    
        /**
         * @var DateTime|null $dateEnd
         *
         * @Assert\NotBlank(
         *     allowNull=false,
         *     groups={"requireEndDate"},
         *     message="Please enter an Ending Date."
         * )
         *
         *
         * @Assert\Date(
         *     message="Please enter a proper Date."
         * )
         *
         * @Assert\GreaterThan(
         *     value="today UTC",
         *     message="Please enter a Date that occurs after today.",
         *     groups={"requireEndDate"}
         *
         * )
         *
         * @ORM\Column(
         *     name="date_end",
         *     type="datetime",
         *     nullable=true,
         *     options={"comment"="Ending Date"}
         *     )
         */
        private $dateEnd;
    
        /**
         * @return DateTime|null
         */
        public function getDateEnd():?DateTime
        {
            return $this->dateEnd;
        }
    
        /**
         * @param  DateTime|null  $dateEnd
         *
         * @return self
         */
        public function setDateEnd(?DateTime $dateEnd):self
        {
            $this->dateEnd = $dateEnd;
    
            return $this;
        }
    
    
    }
