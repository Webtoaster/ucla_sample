<?php

    namespace App\Form\Model;

    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Class AddressBillingFormModel
     *
     * @package App\Form\Model
     */
    class AddressBillingFormModel
    {

        /**
         * @Assert\NotBlank(
         *     groups={"billing_address"},
         *     message="Line 1 of your Billing Address is Required."
         * )
         * @Assert\NotNull(
         *     groups={"billing_address"},
         *     message="Line 1 of your Billing Address is Required."
         * )
         * @Assert\Length(
         *     groups={"billing_address"},
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Billing Address is too short. (Minimum of 8 characters)",
         *     maxMessage="Line 1 of your Billing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $billingAddressLine1;

        /**
         * @Assert\Length(
         *     groups={"billing_address"},
         *     max="128",
         *     maxMessage="Line 2 of your Billing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $billingAddressLine2;

        /**
         * @Assert\NotBlank(
         *     groups={"billing_address"},
         *     message="Please enter a Billing City."
         * )
         * @Assert\NotNull(
         *     groups={"billing_address"},
         *     message="Please enter a Billing City."
         * )
         * @Assert\Length(
         *     groups={"billing_address"},
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Billing Address is too short. (Minimum of 2 characters)",
         *     maxMessage="The City of the Billing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $billingAddressCity;

        /**
         * @Assert\NotBlank(
         *     groups={"billing_address"},
         *     message="Please select a Billing Address State."
         * )
         * @Assert\NotNull(
         *     groups={"billing_address"},
         *     message="Please select a Billing Address State."
         * )
         * @Assert\Length(
         *     groups={"billing_address"},
         *     min="2",
         *     max="2",
         *     minMessage="Please select a Billing Address State.",
         *     maxMessage="Please select a Billing Address State."
         * )
         */
        public $billingAddressState;

        /**
         * @Assert\NotBlank(
         *     groups={"billing_address"},
         *     message="Please enter a Billing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         * @Assert\NotNull(
         *     groups={"billing_address"},
         *     message="Please enter a Billing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         */
        public $billingAddressZipCode;


    }
