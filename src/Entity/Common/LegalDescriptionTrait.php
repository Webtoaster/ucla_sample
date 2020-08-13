<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait LegalDescriptionTrait
     *
     * @package App\Entity\Common
     */
    trait LegalDescriptionTrait
    {
	
	    /**
         * @var string|null $county
         * @Assert\NotBlank(
         *     allowNull=false,
         *     groups={"requireLegalCounty"},
         *     message="Please enter the County Name."
         * )
         * @ORM\Column(
         *     name="county",
         *     type="string",
         *     length=255,
         *     nullable=true,
         *     options={"fixed"=true,"comment"="County Name"}
         * )
         */
        private $county;
        
        /**
         * @var string|null $lot
         * @Assert\NotBlank(
         *     allowNull=false,
         *     groups={"requireLegalLot"},
         *     message="Please enter the Lot Information."
         * )
         * @ORM\Column(
         *     name="lot",
         *     type="string",
         *     length=512,
         *     nullable=true,
         *     options={"fixed"=false,"comment"="Lot or Township part of a Legal Description."}
         * )
         */
	    private $lot;
        
        /**
         * @var string|null $block
         * @Assert\NotBlank(
         *     allowNull=false,
         *     groups={"requireLegalBlock"},
         *     message="Please enter the Block Information."
         * )
         * @ORM\Column(
         *     name="block",
         *     type="string",
         *     length=512,
         *     nullable=true,
         *     options={"fixed"=false,"comment"="Block or Range of a Legal Description."}
         * )
         */
	    private $block;
	
	    /**
         * @var string|null $subdivision
         * @Assert\NotBlank(
         *     allowNull=false,
         *     groups={"requireLegalSubdivision"},
         *     message="Please enter the Subdivision."
         * )
         * @ORM\Column(
         *     name="subdivision",
         *     type="string",
         *     length=512,
         *     nullable=true,
         *     options={"fixed"=false,"comment"="Subdivision or Section of a Legal Description."}
	     * )
	     */
	    private $subdivision;
	
	
	    /**
	     * @var string|null $legalDescription
         * @Assert\NotBlank(
         *     allowNull=false,
         *     groups={"requireLegalDescription"},
         *     message="Please enter the Full Legal Description. (Sometimes referred to as the Metes and Bounds)."
         * )
         * @ORM\Column(
         *     name="legal_description",
         *     type="text",
         *     length=65535,
         *     nullable=true,
         *     options={"comment"="Full Legal Description including Metes and Bounds"}
         * )
         */
	    private $legalDescription;
	
	    /**
	     * @return null|string
         */
        public function getCounty():?string
        {
	        return $this->county;
        }
        
        /**
         * @param  null|string  $county
         *
         * @return self
         */
	    public function setCounty(?string $county):self
        {
            $this->county = $county;
            
            return $this;
        }
        
        /**
         * @return null|string
         */
	    public function getLot():?string
	    {
		    return $this->lot;
        }
        
        /**
         * @param  null|string  $lot
         *
         * @return self
         */
	    public function setLot(?string $lot):self
        {
            $this->lot = $lot;
            
            return $this;
        }
        
        /**
         * @return null|string
         */
	    public function getBlock():?string
	    {
		    return $this->block;
        }
        
        /**
         * @param  null|string  $block
         *
         * @return self
         */
	    public function setBlock(?string $block):self
        {
            $this->block = $block;
            
            return $this;
        }
        
        /**
         * @return null|string
         */
	    public function getSubdivision():?string
	    {
            return $this->subdivision;
        }
        
        /**
         * @param  null|string  $subdivision
         *
         * @return self
         */
	    public function setSubdivision(?string $subdivision):self
        {
            $this->subdivision = $subdivision;
            
            return $this;
        }
        
        
        /**
         * @return null|string
         */
	    public function getLegalDescription():?string
	    {
            return $this->legalDescription;
        }
        
        /**
         * @param  null|string  $legalDescription
         *
         * @return self
         */
	    public function setLegalDescription(?string $legalDescription):self
        {
            $this->legalDescription = $legalDescription;
            
            return $this;
        }
        
        
    }
