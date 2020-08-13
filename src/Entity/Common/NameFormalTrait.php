<?php
	
	namespace App\Entity\Common;
	
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Component\Validator\Constraints as Assert;
	
	/**
	 * Trait NameFormalTrait
	 *
	 * @package App\Entity\Common
	 */
	trait NameFormalTrait
	{
		
		/**
		 * @var string|null $nameFormal
		 * @ORM\Column(
		 *     name="name_formal",
		 *     type="string",
		 *     length=180,
		 *     nullable=true,
		 *     options={"comment"="Formal/Formal Name"}
		 * )
		 * @Assert\Regex(
		 *     pattern="/^[a-zA-Z0-9\s.\-_,]+$/g",
		 *     match=false,
		 *     message="Only enter letters, numbers and spaces are allowed in the Formal/Formal Name.",
		 *     groups={"nameRequired"}
		 * )
		 */
		private $nameFormal;
		
		/**
		 * @return string
		 */
		public function getNameFormal():string
		{
			if($this->nameFormal === NULL || trim($this->nameFormal) === ''){
				return '';
			}
			
			return $this->nameFormal;
		}
		
		/**
		 * @param  string|null  $nameFormal
		 *
		 * @return self
		 */
		public function setNameFormal(string $nameFormal):self
		{
			$this->nameFormal = $nameFormal;
			
			return $this;
		}
		
	}
