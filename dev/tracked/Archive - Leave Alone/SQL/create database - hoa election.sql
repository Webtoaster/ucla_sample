-- use information_schema;
DROP database if exists hoa
;

create database hoa;
use hoa;
SET FOREIGN_KEY_CHECKS = 0;
-- Create tables section -------------------------------------------------
-- Table association
CREATE TABLE `association`
(
    `association_id`       Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Association',
    `company_id`           Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Company',
    `number_of_properties` Int(10) UNSIGNED    DEFAULT 0 COMMENT 'Number of properties in this assocaition',
    `is_active`            Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    `updated_at`           Datetime COMMENT 'TS When Updated',
    `created_at`           Datetime COMMENT 'TS when Inserted',
    PRIMARY KEY (`association_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Table for the Asssociations'
    CHECKSUM = 1
;

CREATE INDEX `fk_idx_association_company_id`
    USING BTREE
    ON
        `association`
            (
             `company_id`
                )
;

-- Table board_member
CREATE TABLE `board_member`
(
    `board_member_id` Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Table',
    `association_id`  Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    `person_id`       Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    `date_start`      Datetime COMMENT 'Date when board member started their service',
    `date_end`        Datetime COMMENT 'Date when the board member ended their service',
    `is_active`       Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    `updated_at`      Datetime COMMENT 'TS When Updated',
    `created_at`      Datetime COMMENT 'TS when Inserted',
    PRIMARY KEY (`board_member_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC
    CHECKSUM = 1
;

CREATE INDEX `fk_idx_board_member_association_id`
    USING BTREE
    ON
        `board_member`
            (
             `association_id`
                )
;

CREATE INDEX `fk_idx_board_member_person_id`
    USING BTREE
    ON
        `board_member`
            (
             `person_id`
                )
;

CREATE UNIQUE INDEX `un_idx_board_member_combined`
    USING BTREE
    ON
        `board_member`
            (
             `association_id`,
             `person_id`
                )
;

-- Table company
CREATE TABLE `company`
(
    `company_id`                Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Company',
    `company_name`              Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Name of the Association',
    `physical_address_line1`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Line 1',
    `physical_address_line2`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Line 1',
    `physical_address_city`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address City',
    `physical_address_state`    Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address State',
    `physical_address_zip_code` Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Zip Code',
    `mailing_address_line1`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Line 1',
    `mailing_address_line2`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Line 1',
    `mailing_address_city`      Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address City',
    `mailing_address_state`     Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address State',
    `mailing_address_zip_code`  Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Zip Code',
    `billing_address_line1`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Billing Address Line 1',
    `billing_address_line2`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Billing Address Line 1',
    `billing_address_city`      Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Billing Address City',
    `billing_address_state`     Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Billing Address State',
    `billing_address_zip_code`  Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Billing Address Zip Code',
    `is_active`                 Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    `updated_at`                Datetime COMMENT 'TS When Updated',
    `created_at`                Datetime COMMENT 'TS when Inserted',
    PRIMARY KEY (`company_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 17
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Table for identifying company type entities.'
    CHECKSUM = 1
;

CREATE INDEX `idx_company_company_name`
    USING BTREE
    ON
        `company`
            (
             `company_name`
                )
;

CREATE INDEX `idx_company_physical_address_zip_code`
    USING BTREE
    ON
        `company`
            (
             `physical_address_zip_code`
                )
;

CREATE INDEX `idx_company_mailing_address_zip_code`
    USING BTREE
    ON
        `company`
            (
             `mailing_address_zip_code`
                )
;

CREATE INDEX `idx_company_billing_address_zip_code`
    USING BTREE
    ON
        `company`
            (
             `billing_address_zip_code`
                )
;

-- Table hoa_staff_member
CREATE TABLE `hoa_staff_member`
(
    `hoa_staff_member_id` Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Table',
    `association_id`      Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    `person_id`           Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    `is_attorney`         Tinyint UNSIGNED NOT NULL DEFAULT 0,
    `is_active`           Tinyint(3) UNSIGNED       DEFAULT 1 COMMENT 'Is record active',
    `job_title`           Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Descripton of off Job',
    `updated_at`          Datetime COMMENT 'TS When Updated',
    `created_at`          Datetime COMMENT 'TS when Inserted',
    PRIMARY KEY (`hoa_staff_member_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'NN Table connecting People who work in the HOAs'
    CHECKSUM = 1
;

CREATE UNIQUE INDEX `un_idx_hoa_staff_member_combined`
    USING BTREE
    ON
        `hoa_staff_member`
            (
             `association_id`,
             `person_id`
                )
;

CREATE INDEX `fk_idx_hoa_staff_member_association_id`
    USING BTREE
    ON
        `hoa_staff_member`
            (
             `association_id`
                )
;

CREATE INDEX `fk_idx_hoa_staff_member_person_id`
    USING BTREE
    ON
        `hoa_staff_member`
            (
             `person_id`
                )
;

-- Table person
CREATE TABLE `person`
(
    `person_id`                 Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Person',
    `name_display`              Varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Display Name',
    `name_first`                Varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'First Name',
    `name_middle`               Varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Middle Name',
    `name_last`                 Varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Last Name',
    `name_suffix`               Varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Suffix',
    `phone_home`                Char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `phone_mobile`              Char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `phone_fax`                 Char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `phone_work`                Char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `phone_work_extension`      Char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `email_address`             Varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `mailing_address_line1`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Line 1',
    `mailing_address_line2`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Line 1',
    `mailing_address_city`      Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address City',
    `mailing_address_state`     Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address State',
    `mailing_address_zip_code`  Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Zip Code',
    `mailing_address_country`   Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Country Code',
    `physical_address_line1`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Line 1',
    `physical_address_line2`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Line 1',
    `physical_address_city`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address City',
    `physical_address_state`    Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address State',
    `physical_address_zip_code` Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Zip Code',
    `updated_at`                Datetime COMMENT 'TS When Updated',
    `created_at`                Datetime COMMENT 'TS when Inserted',
    `is_active`                 Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    PRIMARY KEY (`person_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Defines a Person'
    CHECKSUM = 1
;

CREATE INDEX `idx_person_name_last`
    USING BTREE
    ON
        `person`
            (
             `name_last`
                )
;

CREATE INDEX `idx_person_name_first`
    USING BTREE
    ON
        `person`
            (
             `name_first`
                )
;

CREATE INDEX `idx_person_email_address`
    USING BTREE
    ON
        `person`
            (
             `email_address`
                )
;

CREATE INDEX `idx_person_phone_mobile`
    USING BTREE
    ON
        `person`
            (
             `phone_mobile`
                )
;

-- Table property
CREATE TABLE `property`
(
    `property_id`               Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Property',
    `association_id`            Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    `owner_id`                  Int(10) UNSIGNED COMMENT 'Foreign Key to Person',
    `ext_hoa_property_id`       Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Externally produced foreign key for association tracking',
    `ext_cad_property_id`       Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Externally produced foreign key for county appraisal district',
    `physical_address_line1`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Line 1',
    `physical_address_line2`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Line 1',
    `physical_address_city`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address City',
    `physical_address_state`    Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address State',
    `physical_address_zip_code` Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Zip Code',
    `legal_lot`                 Char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Lot Number(s) from Legal Description',
    `legal_section`             Char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Section Number(s) from Legal Description',
    `legal_block`               Char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Block Number(s) from Legal Description',
    `legal_description`         Varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Full Legal Description',
    `updated_at`                Datetime COMMENT 'TS When Updated',
    `created_at`                Datetime COMMENT 'TS when Inserted',
    `is_active`                 Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    PRIMARY KEY (`property_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Table Defining Property'
    CHECKSUM = 1
;

CREATE INDEX `idx_property_ext_hoa_property_id`
    USING BTREE
    ON
        `property`
            (
             `ext_hoa_property_id`
                )
;

CREATE INDEX `idx_property_ext_cad_property_id`
    USING BTREE
    ON
        `property`
            (
             `ext_cad_property_id`
                )
;

CREATE INDEX `fk_idx_property_association_id`
    USING BTREE
    ON
        `property`
            (
             `association_id`
                )
;

CREATE INDEX `fk_idx_property_owner_id`
    USING BTREE
    ON
        `property`
            (
             `owner_id`
                )
;

-- Table ballot_type
CREATE TABLE `ballot_type`
(
    `ballot_type_id`   Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Ballot_Type',
    `ballot_type`      Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Description of a ballot type.  ie, electronic, proxy, etc.',
    `url_ballot_type`  Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'URL link to get to page describing the Ballot Type',
    `html_ballot_type` Text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'HTML Describing the Ballot Type',
    `is_active`        Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    `updated_at`       Datetime COMMENT 'TS When Updated',
    `created_at`       Datetime COMMENT 'TS when Inserted',
    PRIMARY KEY (`ballot_type_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 10
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Contains the Type of Ballots'
    CHECKSUM = 1
;

-- Table election
CREATE TABLE `election`
(
    `election_id`                      Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Election',
    `association_id`                   Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    `election_type_id`                 Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Election_Type',
    `ballot_type_id`                   Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Ballot_Type',
    `election_name_heading`            Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Line 1 Text to Describe the Election',
    `election_name_subheading`         Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Line 2 Text to Describe the Election',
    `url_election`                     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'URL link to get to page describing the election',
    `html_election_information`        Text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'HTML Describing the Election',
    `ballot_physical_address_line1`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Line 1',
    `ballot_physical_address_line2`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Line 1',
    `ballot_physical_address_city`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address City',
    `ballot_physical_address_state`    Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address State',
    `ballot_physical_address_zip_code` Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Physical Address Zip Code',
    `ballot_mailing_address_line1`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Line 1',
    `ballot_mailing_address_line2`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Line 1',
    `ballot_mailing_address_city`      Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address City',
    `ballot_mailing_address_state`     Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address State',
    `ballot_mailing_address_zip_code`  Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Zip Code',
    `date_start`                       Datetime         NOT NULL COMMENT 'Date and Time when voting starts',
    `date_end`                         Datetime         NOT NULL COMMENT 'Date and Time when voting ends',
    `updated_at`                       Datetime COMMENT 'TS When Updated',
    `created_at`                       Datetime COMMENT 'TS when Inserted',
    `is_active`                        Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    PRIMARY KEY (`election_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC
    CHECKSUM = 1
;

CREATE INDEX `fk_idx_election_association_id`
    USING BTREE
    ON
        `election`
            (
             `association_id`
                )
;

CREATE INDEX `fk_idx_election_election_type_id`
    USING BTREE
    ON
        `election`
            (
             `election_type_id`
                )
;

CREATE INDEX `fk_idx_election_ballot_type_id`
    USING BTREE
    ON
        `election`
            (
             `ballot_type_id`
                )
;

CREATE INDEX `idx_election_date_start`
    USING BTREE
    ON
        `election`
            (
             `date_start`
                )
;

CREATE INDEX `idx_election_date_end`
    USING BTREE
    ON
        `election`
            (
             `date_end`
                )
;

-- Table election_date
CREATE TABLE `election_date`
(
    `election_date_id` Int(10) UNSIGNED                                           NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Ellection_Date',
    `election_id`      Int(10) UNSIGNED                                           NOT NULL COMMENT 'Foreign Key to Election',
    `date_value`       Datetime                                                   NOT NULL COMMENT 'Date to Display',
    `date_label`       Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Label to Display with Date',
    `is_template`      Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    `updated_at`       Datetime COMMENT 'TS When Updated',
    `created_at`       Datetime COMMENT 'TS when Inserted',
    `is_active`        Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    PRIMARY KEY (`election_date_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC
    CHECKSUM = 1
;

CREATE INDEX `fk_idx_election_date_election_id`
    USING BTREE
    ON
        `election_date`
            (
             `election_id`
                )
;

-- Table election_type
CREATE TABLE `election_type`
(
    `election_type_id`   Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Election_Type',
    `election_type`      Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Descripton of Election',
    `url_election_type`  Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'URL link to get to page describing the election',
    `html_election_type` Text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'HTML Describing the Election Type',
    `is_active`          Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    `updated_at`         Datetime COMMENT 'TS When Updated',
    `created_at`         Datetime COMMENT 'TS when Inserted',
    PRIMARY KEY (`election_type_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC
    CHECKSUM = 1
;

-- Table login
CREATE TABLE `login`
(
    `login_id`       Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Login',
    `person_id`      Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    `un`             Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Username',
    `pw`             Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Password for Person',
    `date_pw_starts` Datetime         NOT NULL COMMENT 'Date when Password Starts',
    `date_pw_ends`   Datetime COMMENT 'Date when Password Expires',
    `updated_at`     Datetime COMMENT 'TS When Updated',
    `created_at`     Datetime COMMENT 'TS when Inserted',
    `is_active`      Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    PRIMARY KEY (`login_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC
    CHECKSUM = 1
;

CREATE UNIQUE INDEX `idx_login_un`
    USING BTREE
    ON
        `login`
            (
             `un`
                )
;

CREATE INDEX `idx_login_pw`
    USING BTREE
    ON
        `login`
            (
             `pw`
                )
;

CREATE INDEX `fk_idx_login_person_id`
    USING BTREE
    ON
        `login`
            (
             `person_id`
                )
;

-- Table person_to_association
CREATE TABLE `person_to_association`
(
    `person_to_association_id` Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Table',
    `person_id`                Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    `association_id`           Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    `ext_hoa_person_id`        Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Externally produced foreign key for association tracking',
    `updated_at`               Datetime COMMENT 'TS When Updated',
    `created_at`               Datetime COMMENT 'TS when Inserted',
    `is_active`                Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    PRIMARY KEY (`person_to_association_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'NN Table Defining Links between a Person and an Association'
    CHECKSUM = 1
;

CREATE UNIQUE INDEX `un_idx_person_to_association_combined`
    USING BTREE
    ON
        `person_to_association`
            (
             `person_id`,
             `association_id`
                )
;

CREATE INDEX `fk_idx_person_to_association_person_id`
    USING BTREE
    ON
        `person_to_association`
            (
             `person_id`
                )
;

CREATE INDEX `fk_idx_person_to_association_association_id`
    USING BTREE
    ON
        `person_to_association`
            (
             `association_id`
                )
;

-- Table voter
CREATE TABLE `voter`
(
    `voter_id`             Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Voter',
    `property_id`          Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Property',
    `election_id`          Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Election',
    `association_id`       Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    `is_proxy`             Tinyint(3) UNSIGNED DEFAULT 0 COMMENT 'Is this voter a proxy for another homeowner?',
    `proxy_person_id`      Int(10) UNSIGNED COMMENT 'Foreign Key to Person defining who the proxy is.',
    `updated_by_person_id` Int(10) UNSIGNED COMMENT 'Soft Foreign Key to Person.  Person who updated the data.  On insert, it is the same as created.',
    `created_by_person_id` Int(10) UNSIGNED COMMENT 'Soft Foreign Key to Person.  Person who imported the data.',
    `updated_at`           Datetime COMMENT 'TS When Updated',
    `created_at`           Datetime COMMENT 'TS when Inserted',
    `is_active`            Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    PRIMARY KEY (`voter_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 1
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Table defines the voters in an election.'
    CHECKSUM = 1
;

CREATE UNIQUE INDEX `un_idx_voter_combined`
    USING BTREE
    ON
        `voter`
            (
             `property_id`,
             `election_id`
                )
;

CREATE INDEX `fk_idx_voter_property_id`
    USING BTREE
    ON
        `voter`
            (
             `property_id`
                )
;

CREATE INDEX `fk_idx_voter_election_id`
    USING BTREE
    ON
        `voter`
            (
             `election_id`
                )
;

CREATE INDEX `fk_idx_voter_association_id`
    USING BTREE
    ON
        `voter`
            (
             `association_id`
                )
;

CREATE INDEX `fk_voter_to_proxy_person_id`
    USING BTREE
    ON
        `voter`
            (
             `proxy_person_id`
                )
;

-- Table ballot
CREATE TABLE `ballot`
(
    `ballot_id`         Int(10) UNSIGNED NOT NULL DEFAULT 10000 COMMENT 'Primary Key for Ballot, NOT Autoincrmented',
    `voter_id`          Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Voter',
    `candidate_id`      Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Candidate',
    `ballot_type_id`    Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Ballot_Type',
    `url_online_ballot` Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'URL link to get to online ballot',
    `url_paper_ballot`  Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'URL link to get to PDF Ballot ',
    `uri_paper_trace`   Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'URL link to get to the hard copy of the ballot',
    `is_active`         Tinyint(3) UNSIGNED       DEFAULT 1 COMMENT 'Is record active',
    `updated_at`        Datetime COMMENT 'TS When Updated',
    `created_at`        Datetime COMMENT 'TS when Inserted'
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 1
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Contains Ballots for an election.  There will be one ballot per owner.'
    CHECKSUM = 1
;

CREATE INDEX `fk_idx_ballot_ballot_type_id`
    USING BTREE
    ON
        `ballot`
            (
             `ballot_type_id`
                )
;

CREATE UNIQUE INDEX `un_idx_ballot_ballot_id`
    USING BTREE
    ON
        `ballot`
            (
             `voter_id`,
             `candidate_id`
                )
;

CREATE INDEX `fk_idx_ballot_election_id`
    USING BTREE
    ON
        `ballot`
            (
             `voter_id`
                )
;

CREATE INDEX `fk_idx_ballot_candidate_id`
    USING BTREE
    ON
        `ballot`
            (
             `candidate_id`
                )
;

ALTER TABLE `ballot`
    ADD PRIMARY KEY (`ballot_id`)
;

-- Create triggers for table ballot
CREATE DEFINER = 'root' @'%' TRIGGER `tr_nextval_ballot`
    BEFORE
        INSERT
    ON
        `ballot`
    FOR EACH ROW
BEGIN
    DECLARE max_ballot_id INT;

    SELECT max(ballot_id)
    INTO
        max_ballot_id
    FROM ballot;

    IF NEW.ballot_id = 10000
    THEN
        SET NEW.ballot_id = max_ballot_id + 1;
    END IF;
END;
-- Table candidate
CREATE TABLE `candidate`
(
    `candidate_id`             Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Candidate',
    `election_id`              Int(10) UNSIGNED NOT NULL COMMENT 'FOREIGN Key to Election',
    `is_write_in`              Tinyint(3) UNSIGNED DEFAULT 0 COMMENT 'Is record active',
    `write_in_by_voter_id`     Int(10) UNSIGNED COMMENT 'FOREIGN Key to Voter',
    `name_display`             Varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Display Name',
    `name_first`               Varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'First Name',
    `name_middle`              Varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Middle Name',
    `name_last`                Varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Last Name',
    `name_suffix`              Varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Suffix',
    `display_address_line1`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Line 1',
    `display_address_line2`    Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Line 1',
    `display_address_city`     Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address City',
    `display_address_state`    Char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address State',
    `display_address_zip_code` Char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Mailing Address Zip Code',
    `show_address`             Tinyint(3) UNSIGNED DEFAULT 0 COMMENT 'Display the candidates address?',
    `share_write_in_name`      Tinyint(3) UNSIGNED DEFAULT 0 COMMENT 'Does the Voter want to share the name of the write in they have entered?',
    `updated_at`               Datetime COMMENT 'TS When Updated',
    `created_at`               Datetime COMMENT 'TS when Inserted',
    `is_active`                Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    PRIMARY KEY (`candidate_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Defines the cadidates for the election.'
    CHECKSUM = 1
;

CREATE INDEX `fk_idx_candidate_election_id`
    USING BTREE
    ON
        `candidate`
            (
             `election_id`
                )
;

CREATE INDEX `idx_candidate_name_last`
    USING BTREE
    ON
        `candidate`
            (
             `name_last`
                )
;

CREATE INDEX `idx_candidate_name_display`
    USING BTREE
    ON
        `candidate`
            (
             `name_display`
                )
;

-- Table sessions
CREATE TABLE `sessions`
(
    `sess_id`       Char(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    `sess_data`     Blob                                          NOT NULL,
    `sess_time`     Int(10) UNSIGNED                              NOT NULL,
    `sess_lifetime` Mediumint                                     NOT NULL
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET utf8
    COLLATE utf8_bin
    ROW_FORMAT = Dynamic
;

ALTER TABLE `sessions`
    ADD PRIMARY KEY (`sess_id`)
;

-- Table upload
CREATE TABLE `upload`
(
    `upload_id`      Int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key for Uploaded File',
    `file_path`      Char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `file_name`      Char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `file_extension` Char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    `file_size`      Int(10) UNSIGNED COMMENT 'Size of the file in bytes',
    `image_width`    Int(10) UNSIGNED COMMENT 'Width of the image',
    `image_height`   Int(10) UNSIGNED COMMENT 'Height of the image',
    `is_image`       Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is file and image',
    `is_active`      Tinyint(3) UNSIGNED DEFAULT 1 COMMENT 'Is record active',
    `uploaded_by`    Int(10) UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    `created_at`     Datetime COMMENT 'TS when Inserted',
    PRIMARY KEY (`upload_id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 1
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
    ROW_FORMAT = DYNAMIC COMMENT = 'Contains the upload file information.'
    CHECKSUM = 1
;

-- Create foreign keys (relationships) section -------------------------------------------------
ALTER TABLE `association`
    ADD CONSTRAINT `fk_association_to_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `board_member`
    ADD CONSTRAINT `fk_board_member_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `board_member`
    ADD CONSTRAINT `fk_board_member_to_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `hoa_staff_member`
    ADD CONSTRAINT `fk_hoa_staff_member_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `hoa_staff_member`
    ADD CONSTRAINT `fk_hoa_staff_member_to_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `property`
    ADD CONSTRAINT `fk_property_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `election`
    ADD CONSTRAINT `fk_election_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `election`
    ADD CONSTRAINT `fk_election_to_ballot_type` FOREIGN KEY (`ballot_type_id`) REFERENCES `ballot_type` (`ballot_type_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `election`
    ADD CONSTRAINT `fk_election_to_election_type` FOREIGN KEY (`election_type_id`) REFERENCES `election_type` (`election_type_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `election_date`
    ADD CONSTRAINT `fk_election_date_to_election` FOREIGN KEY (`election_id`) REFERENCES `election` (`election_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `login`
    ADD CONSTRAINT `fk_login_to_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `person_to_association`
    ADD CONSTRAINT `fk_person_to_association_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `person_to_association`
    ADD CONSTRAINT `fk_person_to_association_to_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `voter`
    ADD CONSTRAINT `fk_voter_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `voter`
    ADD CONSTRAINT `fk_voter_to_election` FOREIGN KEY (`election_id`) REFERENCES `election` (`election_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `voter`
    ADD CONSTRAINT `fk_voter_to_property` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `voter`
    ADD CONSTRAINT `fk_voter_to_proxy_person_id` FOREIGN KEY (`proxy_person_id`) REFERENCES `person` (`person_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `ballot`
    ADD CONSTRAINT `fk_ballot_to_ballot_type` FOREIGN KEY (`ballot_type_id`) REFERENCES `ballot_type` (`ballot_type_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `ballot`
    ADD CONSTRAINT `fk_ballot_to_candidate` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`candidate_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `ballot`
    ADD CONSTRAINT `fk_ballot_to_voter` FOREIGN KEY (`voter_id`) REFERENCES `voter` (`voter_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `candidate`
    ADD CONSTRAINT `fk_candidate_to_election_id` FOREIGN KEY (`election_id`) REFERENCES `election` (`election_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

ALTER TABLE `property`
    ADD CONSTRAINT `fk_property_to_owner` FOREIGN KEY (`owner_id`) REFERENCES `person` (`person_id`)
        ON
            DELETE
            NO ACTION
        ON
            UPDATE
            NO ACTION
;

SET FOREIGN_KEY_CHECKS = 1;