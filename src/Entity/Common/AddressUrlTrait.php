<?php
    
    namespace App\Entity\Common;
    
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Trait AddressUrl
     *
     * @author  Tom Olson <olson@webtoaster.com>
     * @package App\Entity\Common
     */
    trait AddressUrlTrait
    {
    
        /**
         * @var string|null $url
         *
         *
         * @ORM\Column(
         *     name="url",
         *     type="string",
         *     length=256,
         *     nullable=true,
         *     options={"comment"="Web Site address"}
         *     )
         *
         * @Assert\Url(
         *     groups={"url", "company", "association", "association_url", "company_url", "candidate_url"},
         *     message="Please enter a valid Web Site Address."
         * )
         */
        private $url;
    
        /**
         * @return string|null
         */
        public function getUrl():?string
        {
            return $this->url;
        }
    
        /**
         * @param  string|null  $url
         *
         * @return $this
         */
        public function setUrl(?string $url):self
        {
            $this->url = $url;
    
            return $this;
        }
    
    }
