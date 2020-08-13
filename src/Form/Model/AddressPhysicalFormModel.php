<?php

    namespace App\Form\Model;

    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Class AddressPhysicalFormModel
     *
     * @package App\Form\Model
     */
    class AddressPhysicalFormModel
    {

        /**
         * @Assert\NotBlank(
         *     groups={"physical_address"},
         *     message="Line 1 of your Physical Address is Required."
         * )
         * @Assert\NotNull(
         *     groups={"physical_address"},
         *     message="Line 1 of your Physical Address is Required."
         * )
         * @Assert\Length(
         *     groups={"physical_address"},
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Physical Address is too short. (Minimum of 8 characters)",
         *     maxMessage="Line 1 of your Physical Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $physicalAddressLine1;

        /**
         * @Assert\Length(
         *     groups={"physical_address"},
         *     max="128",
         *     maxMessage="Line 2 of your Physical Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $physicalAddressLine2;

        /**
         * @Assert\NotBlank(
         *     groups={"physical_address"},
         *     message="Please enter a Physical City."
         * )
         * @Assert\NotNull(
         *     groups={"physical_address"},
         *     message="Please enter a Physical City."
         * )
         * @Assert\Length(
         *     groups={"physical_address"},
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Physical Address is too short. (Minimum of 2 characters)",
         *     maxMessage="The City of the Physical Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $physicalAddressCity;

        /**
         * @Assert\NotBlank(
         *     groups={"physical_address"},
         *     message="Please select a Physical Address State."
         * )
         * @Assert\NotNull(
         *     groups={"physical_address"},
         *     message="Please select a Physical Address State."
         * )
         * @Assert\Length(
         *     groups={"physical_address"},
         *     min="2",
         *     max="2",
         *     minMessage="Please select a Physical Address State.",
         *     maxMessage="Please select a Physical Address State."
         * )
         */
        public $physicalAddressState;

        /**
         * @Assert\NotBlank(
         *     groups={"physical_address"},
         *     message="Please enter a Physical Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         * @Assert\NotNull(
         *     groups={"physical_address"},
         *     message="Please enter a Physical Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         */
        public $physicalAddressZipCode;

    }
