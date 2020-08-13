<?php

    namespace App\Form\Model;

    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Class EmailResendVerification
     *
     * @package App\Form\Model
     */
    class EmailResendVerification
    {

        /**
         * @var string $email
         * @Assert\All({
         *      @Assert\Email(
         *          message="This is not a valid email address."
         *      ),
         *      @Assert\NotBlank(
         *          message="The Email Address cannot be empty or blank."
         *      ),
         *      @Assert\Email(
         *          message="Please enter a valid Email Address."
         *      )
         * })
         */
        public $email;

    }
