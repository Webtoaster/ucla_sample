<?php
	
	namespace App\Entity\Common;
	
	/**
	 * Trait DescriptionTrait
	 *
	 * @author  Tom Olson <olson@webtoaster.com>
	 * @package App\Entity\Common
	 */
	trait DescriptionShortTrait
	{
		
		
		/**
		 * @var string|null $descriptionShort
		 * @ORM\Column(
		 *     name="description_short",
		 *     type="string",
		 *     length=255,
		 *     nullable=true,
		 *     options={"fixed"=true, "comment"="Short Description of the Element"}
		 * )
		 */
		private $descriptionShort;
		
		
		/**
		 * @return string
		 */
		public function getDescriptionShort():string
		{
			if($this->descriptionShort === NULL || trim($this->descriptionShort) === ''){
				return '';
			}
			
			return $this->descriptionShort;
		}
		
		
		/**
		 * @param  string  $descriptionShort
		 *
		 * @return self
		 */
		public function setDescriptionShort(string $descriptionShort):self
		{
			$this->descriptionShort = $descriptionShort;
			
			return $this;
		}
		
		
	}
