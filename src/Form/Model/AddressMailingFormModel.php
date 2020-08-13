<?php

    namespace App\Form\Model;

    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Class AddressMailingFormModel
     *
     * @package App\Form\Model
     */
    class AddressMailingFormModel
    {

        /**
         * @Assert\NotBlank(
         *     groups={"mailing_address"},
         *     message="Line 1 of your Mailing Address is Required."
         * )
         * @Assert\NotNull(
         *     groups={"mailing_address"},
         *     message="Line 1 of your Mailing Address is Required."
         * )
         * @Assert\Length(
         *     groups={"mailing_address"},
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Mailing Address is too short. (Minimum of 8 characters)",
         *     maxMessage="Line 1 of your Mailing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $mailingAddressLine1;

        /**
         * @Assert\Length(
         *     groups={"mailing_address"},
         *     max="128",
         *     maxMessage="Line 2 of your Mailing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $mailingAddressLine2;

        /**
         * @Assert\NotBlank(
         *     groups={"mailing_address"},
         *     message="Please enter a Mailing City."
         * )
         * @Assert\NotNull(
         *     groups={"mailing_address"},
         *     message="Please enter a Mailing City."
         * )
         * @Assert\Length(
         *     groups={"mailing_address"},
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Mailing Address is too short. (Minimum of 2 characters)",
         *     maxMessage="The City of the Mailing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $mailingAddressCity;

        /**
         * @Assert\NotBlank(
         *     groups={"mailing_address"},
         *     message="Please select a Mailing Address State."
         * )
         * @Assert\NotNull(
         *     groups={"mailing_address"},
         *     message="Please select a Mailing Address State."
         * )
         * @Assert\Length(
         *     groups={"mailing_address"},
         *     min="2",
         *     max="2",
         *     minMessage="Please select a Mailing Address State.",
         *     maxMessage="Please select a Mailing Address State."
         * )
         */
        public $mailingAddressState;

        /**
         * @Assert\NotBlank(
         *     groups={"mailing_address"},
         *     message="Please enter a Mailing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         * @Assert\NotNull(
         *     groups={"mailing_address"},
         *     message="Please enter a Mailing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         */
        public $mailingAddressZipCode;

    }
