<?php

    namespace App\Helper;

    use Symfony\Component\HttpFoundation\Session\SessionInterface;

    /**
     * Trait SessionTrait
     *
     * @package App\Helper
     */
    trait SessionTrait
    {


        /**
         * @var SessionInterface
         */
        private $session;

        /**
         * @required
         *
         * @param  SessionInterface  $sessObject
         *
         * @return void|null
         */
        public function setSession(SessionInterface $sessObject):void
        {
            $this->session = $sessObject;
        }


    }
