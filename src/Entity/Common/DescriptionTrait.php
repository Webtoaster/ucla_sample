<?php
	
	namespace App\Entity\Common;
	
	/**
	 * Trait DescriptionTrait
	 *
	 * @author  Tom Olson <olson@webtoaster.com>
	 * @package App\Entity\Common
	 */
	trait DescriptionTrait
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
		 * @var string|null $descriptionLong
		 * @ORM\Column(
		 *     name="description_long",
		 *     type="text",
		 *     length=65535,
		 *     nullable=true,
		 *     options={"comment"="Long Description of the Element.  Can be HTML"}
		 * )
		 */
		private $descriptionLong;
		
		/**
		 * @var bool $displayDescriptionLong
		 * @ORM\Column(
		 *     name="display_description_long",
		 *     type="boolean",
		 *     nullable=false,
		 *     options={"default"=0, "comment"="Boolean - Display the Long Description"}
		 * )
		 */
		private $displayDescriptionLong = FALSE;
		
		
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
		 * @return string
		 */
		public function getDescriptionLong():string
		{
			if($this->descriptionLong === NULL || trim($this->descriptionLong) === ''){
				return '';
			}
			
			return $this->descriptionLong;
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
		
		
		/**
		 * @param  null|string  $descriptionLong
		 *
		 * @return self
		 */
		public function setDescriptionLong(string $descriptionLong):self
		{
			$this->descriptionLong = $descriptionLong;
			
			return $this;
		}
		
		/**
		 * @return bool
		 */
		public function isDisplayDescriptionLong():bool
		{
			return $this->displayDescriptionLong;
		}
		
		/**
		 * @param  bool  $displayDescriptionLong
		 *
		 * @return self
		 */
		public function setDisplayDescriptionLong(bool $displayDescriptionLong):self
		{
			$this->displayDescriptionLong = $displayDescriptionLong;
			
			return $this;
		}
		
		
	}
