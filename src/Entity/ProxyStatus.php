<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\DescriptionTrait;
    use App\Entity\Common\SortOrderTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * @ORM\Entity(repositoryClass="App\Repository\ProxyStatusRepository")
     */
    class ProxyStatus
    {
    
        /**
         * @var int $proxyStatusId
         *
         * @ORM\Column(
         *     name="proxy_status_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for Proxy Status"}
         * )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $proxyStatusId;
    
    
        use DescriptionTrait;
    
        use SortOrderTrait;
    
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
    
    
        /**
         * ProxyStatus constructor.
         *
         * @param  int  $proxyStatusId
         */
        public function __construct(int $proxyStatusId)
        {
            $this->proxyStatusId = $proxyStatusId;
        }
    
        /**
         * @return string
         */
        public function __toString()
        {
            return $this->getDescriptionShort();
        }
    
    
        /**
         * @return int|null
         */
        public function getProxyStatusId():?int
        {
            return $this->proxyStatusId;
        }
    
    
    }
