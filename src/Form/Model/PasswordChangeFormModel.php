<?php

    namespace App\Form\Model;

    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Class PasswordChangeFormModel
     *
     * @package App\Form\Model
     */
    class PasswordChangeFormModel
    {

        /**
         * @var string $oldPassword
         */
        public $oldPassword;

        /**
         * @var string $plainPassword
         *
         * @Assert\All(
         *     @Assert\NotNull(),
         *     @Assert\NotBlank(),
         *     @Assert\Length(),
         *     @Assert\Regex(
         *
         *
         *
         *      )
         *
         * )
         */
        public $plainPassword;

    }
