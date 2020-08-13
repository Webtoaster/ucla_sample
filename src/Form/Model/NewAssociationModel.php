<?php

    namespace App\Form\Model;

    use Symfony\Component\Validator\Constraints as Assert;

    /**
     * Class NewAssociationModel
     *
     * @package App\Form\Model
     */
    class NewAssociationModel
    {

        /**
         *
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="The Company Name cannot be empty."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="The Company Name cannot be empty."
         * )
         * @Assert\Length(
         *     groups={"new_company"},
         *     min="5",
         *     max="128",
         *     minMessage="The Company Name is too Short.  (Mimimum of 5 characters.)",
         *     maxMessage="The Company Name is too Long.  (Maximum of 128 characters.)"
         * )
         */
        public $companyName;


        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Line 1 of your Physical Address is Required."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Line 1 of your Physical Address is Required."
         * )
         * @Assert\Length(
         *     groups={"new_company"},
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Physical Address is too short. (Minimum of 8 characters)",
         *     maxMessage="Line 1 of your Physical Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $physicalAddressLine1;

        /**
         * @Assert\Length(
         *     groups={"new_company"},
         *     max="128",
         *     maxMessage="Line 2 of your Physical Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $physicalAddressLine2;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please enter a Physical City."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please enter a Physical City."
         * )
         * @Assert\Length(
         *     groups={"new_company"},
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Physical Address is too short. (Minimum of 2 characters)",
         *     maxMessage="The City of the Physical Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $physicalAddressCity;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please select a Physical Address State."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please select a Physical Address State."
         * )
         * @Assert\Length(
         *     groups={"new_company"},
         *     min="2",
         *     max="2",
         *     minMessage="Please select a Physical Address State.",
         *     maxMessage="Please select a Physical Address State."
         * )
         */
        public $physicalAddressState = 'Tx';

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please enter a Physical Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please enter a Physical Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         */
        public $physicalAddressZipCode;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Line 1 of your Mailing Address is Required."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Line 1 of your Mailing Address is Required."
         * )
         * @Assert\Length(
         *     groups={"new_company"},
         *     min="8",
         *     max="128",
         *     minMessage="Line 1 of your Mailing Address is too short. (Minimum of 8 characters)",
         *     maxMessage="Line 1 of your Mailing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $mailingAddressLine1;

        /**
         * @Assert\Length(
         *     groups={"new_company"},
         *     max="128",
         *     maxMessage="Line 2 of your Mailing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $mailingAddressLine2;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please enter a Mailing City."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please enter a Mailing City."
         * )
         * @Assert\Length(
         *     groups={"new_company"},
         *     min="2",
         *     max="128",
         *     minMessage="The City of the Mailing Address is too short. (Minimum of 2 characters)",
         *     maxMessage="The City of the Mailing Address is too long. (Maximum of 128 characters)",
         * )
         */
        public $mailingAddressCity;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please select a Mailing Address State."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please select a Mailing Address State."
         * )
         * @Assert\Length(
         *     groups={"new_company"},
         *     min="2",
         *     max="2",
         *     minMessage="Please select a Mailing Address State.",
         *     maxMessage="Please select a Mailing Address State."
         * )
         */
        public $mailingAddressState = 'Tx';

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please enter a Mailing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please enter a Mailing Zip/Postal Code consisting of 5 or 9 digit format. (12345 or 12345-6789)"
         * )
         */
        public $mailingAddressZipCode;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please enter a valid Phone Number."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please enter a valid Phone Number."
         * )
         *
         * @Assert\Regex(
         *     pattern="/(\+?( |-|\.)?\d{1,2}( |-|\.)?)?(\(?\d{3}\)?|\d{3})( |-|\.)?(\d{3}( |-|\.)?\d{4})/",
         *     match=false,
         *     message="Please enter a valid Phone Number."
         * )
         */
        public $phoneWork;

        /**
         * @Assert\Regex(
         *     pattern="/(\+?( |-|\.)?\d{1,2}( |-|\.)?)?(\(?\d{3}\)?|\d{3})( |-|\.)?(\d{3}( |-|\.)?\d{4})/",
         *     match=false,
         *     message="Please enter a valid Fax Number."
         * )
         */
        public $phoneFax;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please enter a Valid Web Site Address starting with http:// or https://."
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please enter a Valid Web Site Address starting with http:// or https://."
         * )
         * @Assert\Url(
         *     message="Please enter a Valid Web Site Address starting with http:// or https://.",
         *     normalizer="trim",
         *     relativeProtocol=TRUE
         * )
         */
        public $url;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="Please supply the number of Homes Under Management in this Community. (Number Only)"
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please supply the number of Homes Under Management in this Community. (Number Only)"
         * )
         * @Assert\Positive(
         *     groups={"new_company"},
         *     message="Please supply the number of Homes Under Management in this Community. (Number Only)"
         * )
         */
        public $numberOfProperties;

        /**
         * @Assert\NotBlank(
         *     groups={"new_company"},
         *     message="LPlease supply the number of Subdivided Sections in this Community. (Number Only)"
         * )
         * @Assert\NotNull(
         *     groups={"new_company"},
         *     message="Please supply the number of Subdivided Sections in this Community. (Number Only)"
         * )
         * @Assert\Positive(
         *     groups={"new_company"},
         *     message="Please supply the number of Subdivided Sections in this Community. (Number Only)"
         * )
         */
        public $numberOfSections;


        public $save_add_another;

        public $save_continue;


    }
