<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait NameHumanTrait
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait NameHumanTrait
    {
    
        /**
         * @var string|null $nameFirst
         * @ORM\Column(
         *     name="name_first",
         *     type="string",
         *     length=32,
         *     nullable=true,
         *     options={"comment"="first name"}
         * )
         * @Assert\NotBlank(
         *     message="You must enter a First Name.",
         *     groups={"person", "registration", "name"}
         * )
         * @Assert\Length(
         *     min = 1,
         *     max = 32,
         *     minMessage = "The First Name must be at least {{ limit }} characters in Length.",
         *     maxMessage = "The First Name must be no longer than {{ limit }} characters in Length.",
         *     groups={"person", "registration", "name"}
         * )
         * @Assert\Regex(
         *     pattern="/^[a-zA-Z\-]+$/g",
         *     match=false,
         *     message="Please enter only Letters in the First Name.",
         *     groups={"person", "registration", "name"}
         * )
         */
        private $nameFirst;
    
    
        /**
         * @var string|null $nameMiddle
         *
         * @ORM\Column(
         *     name="name_middle",
         *     type="string",
         *     length=32,
         *     nullable=true,
         *     options={"comment"="middle name", "name"}
         * )
         *
         * @Assert\Regex(
         *     pattern="/^[a-zA-Z\-]+$/g",
         *     match=false,
         *     message="Please enter only Letters in the Middle Name.",
         *     groups={"person", "registration", "name"}
         * )
         */
        private $nameMiddle;
    
        /**
         * @var string $nameLast
         *
         * @ORM\Column(
         *      name="name_last",
         *      type="string",
         *      length=32,
         *      nullable=true,
         *      options={"comment"="last name"}
         * )
         *
         * @Assert\NotBlank(
         *     message="You must enter a Last Name.",
         *     groups={"person", "registration", "name"}
         * )
         *
         * @Assert\Length(
         *     min = 2,
         *     max = 32,
         *     minMessage = "The Last Name must be at least {{ limit }} characters in Length.",
         *     maxMessage = "The Last Name must be no longer than {{ limit }} characters in Length.",
         *     groups={"person", "registration", "name"}
         * )
         *
         * @Assert\Regex(
         *     pattern="/^[a-zA-Z\-]+$/g",
         *     match=false,
         *     message="Please enter only Letters in the Last Name.",
         *     groups={"person", "registration", "name"}
         * )
         */
        private $nameLast;
    
    
        /**
         * @var string|null $nameSuffix
         *
         * @ORM\Column(
         *     name="name_suffix",
         *     type="string",
         *     length=12,
         *     nullable=true,
         *     options={"comment"="suffix"})
         *
         * @Assert\Regex(
         *     pattern="/^[a-zA-Z\-]+$/g",
         *     match=false,
         *     message="Please enter only Letters in the Suffix.",
         *     groups={"person", "registration", "name_suffix"}
         * )
         */
        private $nameSuffix;
    
    
        /**
         * @return string|null
         */
        public function getNameFirst():?string
        {
            return $this->nameFirst;
        }
    
        /**
         * @param  string  $nameFirst
         *
         * @return self
         */
        public function setNameFirst(string $nameFirst):self
        {
            $this->nameFirst = $nameFirst;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getNameMiddle():?string
        {
            return $this->nameMiddle;
        }
    
        /**
         * @param  string|null  $nameMiddle
         *
         * @return self
         */
        public function setNameMiddle(?string $nameMiddle):self
        {
            $this->nameMiddle = $nameMiddle;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getNameLast():?string
        {
            return $this->nameLast;
        }
    
        /**
         * @param  string  $nameLast
         *
         * @return self
         */
        public function setNameLast(string $nameLast):self
        {
            $this->nameLast = $nameLast;
    
            return $this;
        }
    
        /**
         * @return string|null
         */
        public function getNameSuffix():?string
        {
            return $this->nameSuffix;
        }
    
        /**
         * @param  string|null  $nameSuffix
         *
         * @return self
         */
        public function setNameSuffix(?string $nameSuffix):self
        {
            $this->nameSuffix = $nameSuffix;
    
            return $this;
        }
    
    }
