<?php

    namespace App\Helper;

    use Psr\Log\LoggerInterface;

    /**
     * Trait Logger
     *
     * @package App\Helper
     */
    trait Logger
    {

        /**
         * @var LoggerInterface|null
         */
        private $logger;

        /**
         * @required
         *
         * @param  LoggerInterface  $logger
         *
         * @return void|null
         */
        public function setLogger(LoggerInterface $logger):void
        {
            $this->logger = $logger;
        }


        /**
         * @param  string  $message
         * @param  array   $context
         */
        private function logInfo(string $message, array $context = []):void
        {
            if ($this->logger) {
                $this->logger->info($message, $context);
            }
        }

    }
