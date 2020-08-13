-- use information_schema;


DROP DATABASE IF EXISTS hoa
;

CREATE DATABASE hoa;
USE hoa;
SET FOREIGN_KEY_CHECKS = 0;



CREATE TABLE `association`
(
    `association_id`        int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Association',

    `company_id`            int(10) unsigned          DEFAULT NULL COMMENT 'Foreign Key to Company',
    `management_company_id` int(10) unsigned          DEFAULT NULL COMMENT 'Foreign Key to Company',

    `number_of_properties`  int(10) unsigned NOT NULL DEFAULT 1 COMMENT 'Number of Properties in Association',
    `number_of_sections`    int(10) unsigned NOT NULL DEFAULT 1 COMMENT 'Number of Neighborhood Sections',

    `updated_at`            datetime                  DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`            datetime                  DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`             tinyint(1)       NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`association_id`),
    KEY `idx_fk_association_company_to_company` (`company_id`) USING BTREE,
    KEY `idx_fk_association_management_co_to_company` (`management_company_id`) USING BTREE,
    CONSTRAINT `fk_association_to_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_management_company_to_company` FOREIGN KEY (`management_company_id`) REFERENCES `company` (`company_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Associations';

CREATE TABLE `association_staff`
(
    `association_staff_id` int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Association_Staff',

    `association_id`       int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Association',
    `person_id`            int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Person',

    `job_title`            char(128)                    DEFAULT NULL COMMENT 'Job Title or Description',
    `is_attorney`          tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT 'Is Staff Member Association Counsel',
    `is_board_member`      tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT 'Is This Staff Member Also a Board Member?',
    `date_start`           datetime                     DEFAULT NULL COMMENT 'Date Start',
    `date_end`             datetime                     DEFAULT NULL COMMENT 'Date End',

    `updated_at`           datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`           datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`            tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'flag if record is active',
    PRIMARY KEY (`association_staff_id`),
    UNIQUE KEY `un_idx_hoa_staff_member_combined` (`association_id`, `person_id`) USING BTREE,
    KEY `idx_fk_fk_hoa_staff_member_to_association` (`association_id`) USING BTREE,
    KEY `fk_hoa_staff_member_to_person` (`person_id`) USING BTREE,
    CONSTRAINT `fk_hoa_staff_member_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_hoa_staff_member_to_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Staff of Persons who work for an Association';

CREATE TABLE `ballot`
(
    `ballot_id`         int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Ballot',

    `voter_id`          int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Voter',
    `ballot_type_id`    int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Ballot_Type',

    `ballot_key`        char(64)                     DEFAULT NULL COMMENT 'Key to Transfer a Ballot to a Proxy',
    `ip_address`        char(15)                     DEFAULT NULL COMMENT 'IP Address that ballot was cast from.',
    `url_online_ballot` char(255)                    DEFAULT NULL COMMENT 'URL Link to get Online Ballot',
    `url_paper_ballot`  char(255)                    DEFAULT NULL COMMENT 'URL Link to get Pdf Ballot ',
    `url_paper_trace`   char(255)                    DEFAULT NULL COMMENT 'URL Link to get The Hard Copy of The Ballot',
    `date_cast`         datetime                     DEFAULT NULL COMMENT 'Date and Time Ballot was Cast',
    `prior_ballot_id`   int(10) unsigned             DEFAULT NULL COMMENT 'Prior Ballot ID (Self Referencing)',

    `updated_at`        datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`        datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`         tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`ballot_id`),
    UNIQUE KEY `un_idx_ballot_ballot_id` (`voter_id`) USING BTREE,
    KEY `fk_idx_ballot_ballot_type_id` (`ballot_type_id`) USING BTREE,
    CONSTRAINT `fk_ballot_to_ballot_type` FOREIGN KEY (`ballot_type_id`) REFERENCES `ballot_type` (`ballot_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_ballot_to_voter` FOREIGN KEY (`voter_id`) REFERENCES `voter` (`voter_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Ballots';

CREATE TABLE `ballot_type`
(
    `ballot_type_id`   int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Ballot_Type',

    `ballot_type`      char(128)           NOT NULL COMMENT 'Description of a Ballot Type.  (Ie, Electronic, Proxy, etc.)',
    `url_ballot_type`  char(255)                    DEFAULT NULL COMMENT 'URL Link to get to Page Describing The Ballot Type',
    `html_ballot_type` text                         DEFAULT NULL COMMENT 'Html Describing The Ballot Type',

    `updated_at`       datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`       datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`        tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`ballot_type_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 10
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Types of ballots';

CREATE TABLE `candidate`
(
    `candidate_id`              INT(10) UNSIGNED    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Candidate',

    `election_id`               INT(10) UNSIGNED             DEFAULT NULL COMMENT 'Foreign Key to Election',
    `write_in_by_voter_id`      INT(10) UNSIGNED             DEFAULT NULL COMMENT 'Foreign Key to Voter',

    `is_write_in`               TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Is a Write in Vote',

    `name_display`              CHAR(108)           NOT NULL COMMENT 'Display Name',
    `name_first`                CHAR(32)            NOT NULL COMMENT 'First Name',
    `name_middle`               CHAR(32)                     DEFAULT NULL COMMENT 'Middle Name',
    `name_last`                 CHAR(32)            NOT NULL COMMENT 'Last Name',
    `name_suffix`               CHAR(12)                     DEFAULT NULL COMMENT 'Suffix',


    `physical_address_line1`    CHAR(128)           NOT NULL COMMENT 'Address Line 1',
    `physical_address_line2`    CHAR(128)                    DEFAULT NULL COMMENT 'Address Line 2',
    `physical_address_city`     CHAR(128)           NOT NULL COMMENT 'City',
    `physical_address_state`    CHAR(2)             NOT NULL COMMENT 'State',
    `physical_address_zip_code` CHAR(16)            NOT NULL COMMENT 'Zip Code',

    `phone_mobile`              CHAR(14)                     DEFAULT NULL COMMENT 'Mobile Phone',
    `email_address`             CHAR(128)           NOT NULL COMMENT 'Email Address',
    `display_candidate_address` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Display The Candidates Address',
    `share_write_in_name`       TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Does The Voter Want to Share The Name of The Write in They Have Entered',

    `updated_at`                DATETIME                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`                DATETIME                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`                 TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`candidate_id`),
    KEY `fk_idx_candidate_election_id` (`election_id`) USING BTREE,
    KEY `idx_candidate_name_last` (`name_last`) USING BTREE,
    KEY `idx_candidate_name_display` (`name_display`) USING BTREE,
    CONSTRAINT `fk_candidate_to_election_id` FOREIGN KEY (`election_id`) REFERENCES `election` (`election_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Candidates in an Election';

CREATE TABLE `company`
(
    `company_id`                int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Company',

    `person_id`                 INT(10) UNSIGNED             DEFAULT NULL COMMENT 'Foreign Key to Person',

    `company_name`              char(128)           NOT NULL COMMENT 'Company Name',

    `physical_address_line1`    char(128)           NOT NULL COMMENT 'Address Line 1',
    `physical_address_line2`    char(128)                    DEFAULT NULL COMMENT 'Address Line 2',
    `physical_address_city`     char(128)           NOT NULL COMMENT 'City',
    `physical_address_state`    char(2)             NOT NULL COMMENT 'State',
    `physical_address_zip_code` char(16)            NOT NULL COMMENT 'Zip Code',

    `mailing_address_line1`     char(128)           NOT NULL COMMENT 'Address Line 1',
    `mailing_address_line2`     char(128)                    DEFAULT NULL COMMENT 'Address Line 2',
    `mailing_address_city`      char(128)           NOT NULL COMMENT 'City',
    `mailing_address_state`     char(2)             NOT NULL COMMENT 'State',
    `mailing_address_zip_code`  char(16)            NOT NULL COMMENT 'Zip Code',

    `billing_address_line1`     char(128)                    DEFAULT NULL COMMENT 'Address Line 1',
    `billing_address_line2`     char(128)                    DEFAULT NULL COMMENT 'Address Line 2',
    `billing_address_city`      char(128)                    DEFAULT NULL COMMENT 'City',
    `billing_address_state`     char(2)                      DEFAULT NULL COMMENT 'State',
    `billing_address_zip_code`  char(16)                     DEFAULT NULL COMMENT 'Zip Code',

    `phone_fax`                 CHAR(14)                     DEFAULT NULL COMMENT 'Fax Phone',
    `phone_work`                CHAR(14)                     DEFAULT NULL COMMENT 'Company Phone',
    `url`                       char(255)                    DEFAULT NULL COMMENT 'URL of Company Web Site',

    `updated_at`                datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`                datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`                 tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`company_id`),
    KEY `idx_company_person_id` (`person_id`) USING BTREE,
    KEY `idx_company_company_name` (`company_name`) USING BTREE,
    KEY `idx_company_physical_address_zip_code` (`physical_address_zip_code`) USING BTREE,
    KEY `idx_company_mailing_address_zip_code` (`mailing_address_zip_code`) USING BTREE,
    KEY `idx_company_billing_address_zip_code` (`billing_address_zip_code`) USING BTREE,

    CONSTRAINT `fk_company_to_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION

) ENGINE = InnoDB
  AUTO_INCREMENT = 19
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Company type entities.';

CREATE TABLE `election`
(
    `election_id`                  INT(10) UNSIGNED     NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Election',
    `association_id`               INT(10) UNSIGNED              DEFAULT NULL COMMENT 'Foreign Key to Association',
    `election_type_id`             INT(10) UNSIGNED              DEFAULT NULL COMMENT 'Foreign Key to Election_Type',

    `election_name_heading`        CHAR(128)            NOT NULL COMMENT 'Election Description Heading',
    `election_name_subheading`     CHAR(128)                     DEFAULT NULL COMMENT 'Election Description Sub-Heading',

    `url_election`                 CHAR(255)                     DEFAULT NULL COMMENT 'URL Link to get to Page Describing The Election',

    `html_election_information`    TEXT                 NOT NULL COMMENT 'HTML Describing The Election',

    `physical_address_line1`       CHAR(128)            NOT NULL COMMENT 'Address Line 1',
    `physical_address_line2`       CHAR(128)                     DEFAULT NULL COMMENT 'Address Line 2',
    `physical_address_city`        CHAR(128)            NOT NULL COMMENT 'City',
    `physical_address_state`       CHAR(2)              NOT NULL DEFAULT 'TX' COMMENT 'State',
    `physical_address_zip_code`    CHAR(16)             NOT NULL COMMENT 'Zip Code',
    `display_physical_address`     TINYINT(1) UNSIGNED  NOT NULL DEFAULT 1 COMMENT 'Display The Physical Address',

    `mailing_address_line1`        CHAR(128)            NOT NULL COMMENT 'Address Line 1',
    `mailing_address_line2`        CHAR(128)                     DEFAULT NULL COMMENT 'Address Line 2',
    `mailing_address_city`         CHAR(128)            NOT NULL COMMENT 'City',
    `mailing_address_state`        CHAR(2)              NOT NULL DEFAULT 'TX' COMMENT 'State',
    `mailing_address_zip_code`     CHAR(16)             NOT NULL COMMENT 'Zip Code',
    `display_mailing_address`      TINYINT(1) UNSIGNED  NOT NULL DEFAULT 1 COMMENT 'Display The Mailing Address',

    `votes_min`                    SMALLINT(5) UNSIGNED NOT NULL COMMENT 'Minimum Number of Votes that can be Cast',
    `votes_max`                    SMALLINT(5) UNSIGNED NOT NULL COMMENT 'Maximum Number of Votes that can be Cast',

    `date_start`                   DATETIME             NOT NULL COMMENT 'Date and Time When Voting Starts',
    `date_end`                     DATETIME             NOT NULL COMMENT 'Date and Time When Voting Ends',

    `voters_total`                 INT(10) UNSIGNED     NOT NULL COMMENT 'Total Number of Voters.',
    `voters_required_election`     INT(10) UNSIGNED     NOT NULL COMMENT 'Total Number of Votes Required to Make This Election Official',
    `voters_required_ratification` INT(10) UNSIGNED     NOT NULL COMMENT 'Number of Voters Required to Ratify a Bylaw Or a Deed Restriction',
    `votes_min_per_bylaws`         SMALLINT(5) UNSIGNED NOT NULL COMMENT 'Minimum Number of Votes that can be Cast per Bylaws',
    `votes_min_per_statute`        SMALLINT(5) UNSIGNED NOT NULL COMMENT 'Minimum Number of Votes that can be Cast per Statute',

    `election_state`               CHAR(2)              NOT NULL DEFAULT 'TX' COMMENT 'State',

    `allow_write_in_candidates`    TINYINT(1) UNSIGNED           DEFAULT 0 COMMENT 'Will You Allow Write in Candidates?',
    `allow_proxy_voting`           TINYINT(1) UNSIGNED           DEFAULT 1 COMMENT 'Will You Allow Proxy Voting?',
    `allow_proxy_directed`         TINYINT(1) UNSIGNED           DEFAULT 0 COMMENT 'Will This Election Use Directed Proxies?',
    `allow_proxy_nondirected`      TINYINT(1) UNSIGNED           DEFAULT 0 COMMENT 'Will This Election Use Non-Directed Proxies?',

    `updated_at`                   DATETIME                      DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`                   DATETIME                      DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`                    TINYINT(1) UNSIGNED  NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`election_id`),
    KEY `fk_idx_election_association_id` (`association_id`) USING BTREE,
    KEY `idx_election_date_start` (`date_start`) USING BTREE,
    KEY `idx_election_date_end` (`date_end`) USING BTREE,
    KEY `idx_fk_fk_election_to_election_type` (`election_type_id`) USING BTREE,
    CONSTRAINT `fk_election_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_election_to_election_type` FOREIGN KEY (`election_type_id`) REFERENCES `election_type` (`election_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC
    COMMENT ='Election Events';

CREATE TABLE `election_date`
(
    `election_date_id` int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Election_Date',
    `election_id`      int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Election',
    `date_value`       datetime            NOT NULL COMMENT 'Date and Time of Election',
    `date_label`       varchar(512)        NOT NULL COMMENT 'Label to Display With Date',

    `updated_at`       datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`       datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`        tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`election_date_id`),
    KEY `fk_idx_election_date_election_id` (`election_id`) USING BTREE,
    KEY `idx_election_date_dates_and_election_id` (`election_id`, `date_label`) USING BTREE,
    CONSTRAINT `fk_election_date_to_election` FOREIGN KEY (`election_id`) REFERENCES `election` (`election_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC
    COMMENT ='Election Dates';

CREATE TABLE `election_type`
(
    `election_type_id`   int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Election_Type',
    `election_type`      text                NOT NULL COMMENT 'Description of Election Type',
    `url_election_type`  char(255)                    DEFAULT NULL COMMENT 'URL Link to get to Page Describing The Election',
    `html_election_type` text                         DEFAULT NULL COMMENT 'Html Describing The Election Type',

    `updated_at`         datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`         datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`          tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`election_type_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC
    COMMENT ='Election Types';



CREATE TABLE `person`
(
    `id`                       int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Person',
    `person_type_id`           INT(10) UNSIGNED                                              DEFAULT NULL COMMENT 'Foreign Key to Person_Type',

    `name_display`             CHAR(108)                                                     DEFAULT NULL COMMENT 'Display Name',
    `name_first`               CHAR(32)         NOT NULL COMMENT 'First Name',
    `name_middle`              CHAR(32)                                                      DEFAULT NULL COMMENT 'Middle Name',
    `name_last`                CHAR(32)         NOT NULL COMMENT 'Last Name',
    `name_suffix`              CHAR(12)                                                      DEFAULT NULL COMMENT 'Suffix',

    `phone_home`               CHAR(14)                                                      DEFAULT NULL COMMENT 'Home Phone',
    `phone_mobile`             CHAR(14)                                                      DEFAULT NULL COMMENT 'Mobile Phone',
    `phone_fax`                CHAR(14)                                                      DEFAULT NULL COMMENT 'Fax Phone',
    `phone_work`               CHAR(14)                                                      DEFAULT NULL COMMENT 'Work Phone',


    `email`                    VARCHAR(180)     NOT NULL COMMENT 'Email Address',
    `roles`                    JSON                                                          DEFAULT NULL COMMENT 'Roles User Holds',
    `password`                 VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'This is NULL because non-user objects will also be stored within.',

    `mailing_address_line1`    CHAR(128)                                                     DEFAULT NULL COMMENT 'Address Line 1',
    `mailing_address_line2`    char(128)                                                     DEFAULT NULL COMMENT 'Address Line 2',
    `mailing_address_city`     char(128)                                                     DEFAULT NULL COMMENT 'City',
    `mailing_address_state`    char(2)                                                       DEFAULT NULL COMMENT 'State',
    `mailing_address_zip_code` char(16)                                                      DEFAULT NULL COMMENT 'Zip Code',
    `mailing_address_country`      char(2)                                                       DEFAULT NULL COMMENT 'Country',

    `physical_address_line1`       char(128)                                                     DEFAULT NULL COMMENT 'Address Line 1',
    `physical_address_line2`       char(128)                                                     DEFAULT NULL COMMENT 'Address Line 2',
    `physical_address_city`        char(128)                                                     DEFAULT NULL COMMENT 'City',
    `physical_address_state`       char(2)                                                       DEFAULT NULL COMMENT 'State',
    `physical_address_zip_code`    char(16)                                                      DEFAULT NULL COMMENT 'Zip Code',

    `ip_address`                   char(39)                                                      DEFAULT NULL COMMENT 'ip address where the Person was submitted from.',
    `password_recovery_key`        char(32)                                                      DEFAULT NULL COMMENT 'Key to be included in password recovery.',
    `password_recovery_date`       datetime                                                      DEFAULT NULL COMMENT 'Date password recovery was made.',
    `password_recovery_ip_address` char(39)                                                      DEFAULT NULL COMMENT 'IP Address where the password request was made.',

    `verification_key`             char(32)                                                      DEFAULT NULL COMMENT 'Key to be included in email verification.',
    `verification_date`            datetime                                                      DEFAULT NULL COMMENT 'Verification Date of Email',
    `verification_ip_address`      char(39)                                                      DEFAULT NULL COMMENT 'IP Address where the verification was made from.',

    `has_started_registration`     tinyint(1) unsigned NOT NULL                                  DEFAULT 0 COMMENT 'Has this person started registration?',
    `is_verified`                  tinyint(1) unsigned NOT NULL                                  DEFAULT 0 COMMENT 'Is Email Address Verified',
    `is_registered`                tinyint(1) unsigned NOT NULL                                  DEFAULT 0 COMMENT 'Is Person Registered',

    `agreed_to_terms_at`           datetime                                                      DEFAULT NULL COMMENT 'PHP Timestamp when the user agreed to terms',
    `terms_id`                     int(10) unsigned                                              DEFAULT 1 COMMENT 'Future Foreign Key field to more complex legal framework.',

    `updated_at`                   datetime                                                      DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`                   datetime                                                      DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`                    tinyint(1)          NOT NULL                                  DEFAULT 0 COMMENT 'Is this Record Active',
    PRIMARY KEY (`id`),
    KEY `idx_person_name_last` (`name_last`) USING BTREE,
    KEY `idx_person_name_first` (`name_first`) USING BTREE,
    KEY `idx_person_phone_mobile` (`phone_mobile`) USING BTREE,
    KEY `idx_person_phone_home` (`phone_home`) USING BTREE,
    KEY `idx_person_phone_work` (`phone_work`) USING BTREE,
    KEY `idx_person_email` (`email`) USING BTREE,
    KEY `idx_person_password_recovery_key` (`password_recovery_key`) USING BTREE,
    KEY `idx_person_created_at` (`created_at`) USING BTREE,
    KEY `idx_person_verification_key` (`verification_key`) USING BTREE,
    KEY `fk_person_to_person_type` (`person_type_id`),
    CONSTRAINT `fk_person_to_person_type` FOREIGN KEY (`person_type_id`)
        REFERENCES `person_type` (`person_type_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
) ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Defines a Person as an Entity Type';



CREATE TABLE `person_type`
(
    `person_type_id`    int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Person_Type',
    `person_type_key`   text                NOT NULL COMMENT 'Long Description of Person Type',
    `person_type_value` char(255)                    DEFAULT NULL COMMENT 'Short Description of Person Type',

    `updated_at`        datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`        datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`         tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`person_type_id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Person Types for Registration';



CREATE TABLE `property`
(
    `property_id`               int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Property',

    `owner_id`                  int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Owner',
    `association_id`            int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Association',

    `ext_hoa_property_id`       char(128)                    DEFAULT NULL COMMENT 'External Key From Internal Association System',
    `ext_cad_property_id`       char(128)                    DEFAULT NULL COMMENT 'External Key From County Appraisal District',

    `date_start`                datetime            NOT NULL COMMENT 'Date Ownership Started',
    `date_end`                  datetime                     DEFAULT NULL COMMENT 'Date Ownership Ended',

    `physical_address_line1`    char(128)           NOT NULL COMMENT 'Address Line 1',
    `physical_address_line2`    char(128)                    DEFAULT NULL COMMENT 'Address Line 2',
    `physical_address_city`     char(128)           NOT NULL COMMENT 'City',
    `physical_address_state`    char(2)             NOT NULL DEFAULT 'TX' COMMENT 'State',
    `physical_address_zip_code` char(16)            NOT NULL COMMENT 'Zip Code',

    `legal_lot`                 char(32)                     DEFAULT NULL COMMENT 'Legal Description Lot',
    `legal_section`             char(32)                     DEFAULT NULL COMMENT 'Legal Description Section',
    `legal_block`               char(32)                     DEFAULT NULL COMMENT 'Legal Description Block',
    `legal_description`         text                         DEFAULT NULL COMMENT 'Full Legal Description',


    `updated_at`                datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`                datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`                 tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`property_id`),
    KEY `idx_property_ext_hoa_property_id` (`ext_hoa_property_id`) USING BTREE,
    KEY `idx_property_ext_cad_property_id` (`ext_cad_property_id`) USING BTREE,
    KEY `fk_idx_property_to_owner` (`owner_id`) USING BTREE,
    KEY `fk_property_to_association` (`association_id`) USING BTREE,
    CONSTRAINT `fk_property_to_association` FOREIGN KEY (`association_id`) REFERENCES `association` (`association_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_property_to_owner` FOREIGN KEY (`owner_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Defines the Property as an Entity Type';

CREATE TABLE `sessions`
(
    `sess_id`       varchar(128) COLLATE utf8_bin NOT NULL,
    `sess_data`     blob                          NOT NULL,
    `sess_time`     int(10) unsigned              NOT NULL,
    `sess_lifetime` mediumint(9)                  NOT NULL,
    PRIMARY KEY (`sess_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_bin
    COMMENT ='Symfony Sessions Table';

CREATE TABLE `upload`
(
    `upload_id`      int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Uploads',

    `uploaded_by`    int(10) unsigned    NOT NULL COMMENT 'Foreign Key to Person',

    `file_path`      char(128)           NOT NULL COMMENT 'File Path',
    `file_name`      char(64)            NOT NULL COMMENT 'File Name',
    `file_extension` char(4)             NOT NULL COMMENT 'File Extension',
    `file_size`      int(10) unsigned             DEFAULT NULL COMMENT 'Size of The File (In Bytes)',

    `is_image`       tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT 'Is File An Image',
    `image_width`    int(10) unsigned             DEFAULT NULL COMMENT 'Image Width',
    `image_height`   int(10) unsigned             DEFAULT NULL COMMENT 'Image Height',

    `updated_at`     datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`     datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`      tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`upload_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Contains the uploaded file information';

CREATE TABLE `vote`
(
    `ballot_id`    int(10) unsigned NOT NULL COMMENT 'Duplex Primary Key For Vote - Ballot Id',
    `candidate_id` int(10) unsigned NOT NULL COMMENT 'Duplex Primary Key For Vote - Candidate Id',
    PRIMARY KEY (`ballot_id`, `candidate_id`),
    KEY `idx_fk_relationship5` (`ballot_id`) USING BTREE,
    KEY `idx_fk_relationship6` (`candidate_id`) USING BTREE,
    CONSTRAINT `fk_vote_to_ballot` FOREIGN KEY (`ballot_id`) REFERENCES `ballot` (`ballot_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_vote_to_candidate` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`candidate_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Contains the Votes Cast';

CREATE TABLE `voter`
(
    `voter_id`             int(10) unsigned    NOT NULL AUTO_INCREMENT COMMENT 'Primary Key to Voter',

    `property_id`          int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Property',
    `election_id`          int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Election',

    `is_proxy`             tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT 'Is This Voter a Proxy For Another Homeowner',
    `proxy_person_id`      int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Person',

    `updated_by_person_id` int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Person (Soft and who Imported The Data)',
    `created_by_person_id` int(10) unsigned             DEFAULT NULL COMMENT 'Foreign Key to Person (Soft and who Imported The Data)',

    `memorandum`           text                         DEFAULT NULL COMMENT 'Memorandum on Voter',

    `updated_at`           datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when updated',
    `created_at`           datetime                     DEFAULT NULL COMMENT 'PHP Timestamp when inserted',
    `is_active`            tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Is this Record Active',
    PRIMARY KEY (`voter_id`),
    UNIQUE KEY `un_idx_voter_combined` (`property_id`, `election_id`) USING BTREE,
    KEY `fk_idx_voter_property_id` (`property_id`) USING BTREE,
    KEY `fk_idx_voter_election_id` (`election_id`) USING BTREE,
    KEY `fk_voter_to_proxy_person_id` (`proxy_person_id`) USING BTREE,
    CONSTRAINT `fk_voter_to_election` FOREIGN KEY (`election_id`) REFERENCES `election` (`election_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_voter_to_property` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_voter_to_proxy_person_id` FOREIGN KEY (`proxy_person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  CHECKSUM = 1
  ROW_FORMAT = DYNAMIC COMMENT ='Defines the Persons who are allowed to vote.';



SET FOREIGN_KEY_CHECKS = 1;
GRANT ALL PRIVILEGES ON hoa.* to 'hoa_user'@'%' IDENTIFIED BY 'ThisPasswordIsStrong';


-- Data for Person Type
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE person_type;
INSERT INTO person_type
    (person_type_id, person_type_key, person_type_value, updated_at, created_at, is_active)
VALUES (100, 'association_self_managed', 'I work for a Self-Managed Homeowner\'s / Property Owner\'s Association.', now(),
        now(), 1),
       (200, 'association_management_company', 'I work for a HOA Management Company.', now(), now(), 1),
       (300, 'association_member_testing', 'I am a Member of an Association Evaluating the Software.', now(), now(), 1);


SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE person;
SET FOREIGN_KEY_CHECKS = 1;


SET FOREIGN_KEY_CHECKS = 0;
INSERT INTO `person`( `id`
                    , `person_type_id`
                    , `name_display`
                    , `name_first`
                    , `name_middle`
                    , `name_last`
                    , `name_suffix`
                    , `phone_home`
                    , `phone_mobile`
                    , `phone_fax`
                    , `phone_work`
                    , `email`
                    , `roles`
                    , `password`
                    , `mailing_address_line1`
                    , `mailing_address_line2`
                    , `mailing_address_city`
                    , `mailing_address_state`
                    , `mailing_address_zip_code`
                    , `mailing_address_country`
                    , `physical_address_line1`
                    , `physical_address_line2`
                    , `physical_address_city`
                    , `physical_address_state`
                    , `physical_address_zip_code`
                    , `ip_address`
                    , `password_recovery_key`
                    , `password_recovery_date`
                    , `password_recovery_ip_address`
                    , `verification_key`
                    , `verification_date`
                    , `verification_ip_address`
                    , `has_started_registration`
                    , `is_verified`
                    , `is_registered`
                    , `agreed_to_terms_at`
                    , `terms_id`
                    , `updated_at`
                    , `created_at`
                    , `is_active`)
VALUES ( 5
       , NULL
       , 'Tom Olson - User'
       , 'Tom'
       , 'E'
       , 'Olson'
       , NULL
       , '281-256-2306'
       , '281-256-2306'
       , NULL
       , '281-256-2306'
       , 'olson@webtoaster.com'
       , '[
    "ROLE_USER"
  ]'
       , '$argon2id$v=19$m=65536,t=6,p=1$cVlSUEdkZDB6OXB2REZCSw$OumrGZiFQQs/5gsm+jJMU4loaXtdK+eQe9s9RtvUwg8'
       , '1600 Pennsylvania Avenue'
       , NULL
       , 'Washington'
       , 'DC'
       , '22001'
       , 'US'
       , '1600 Pennsylvania Avenue'
       , NULL
       , 'Washington'
       , 'DC'
       , '22001'
       , '127.0.0.1'
       , NULL
       , NULL
       , NULL
       , '550cad371653ab77cc337de0ad2094d8'
       , '2019-07-15 09:49:51'
       , '127.0.0.1'
       , 1
       , 1
       , 1
       , '2019-07-15 09:49:51'
       , 1
       , '2019-07-15 09:49:49'
       , '2019-07-15 09:49:49'
       , 1);

INSERT INTO `person`( `id`
                    , `person_type_id`
                    , `name_display`
                    , `name_first`
                    , `name_middle`
                    , `name_last`
                    , `name_suffix`
                    , `phone_home`
                    , `phone_mobile`
                    , `phone_fax`
                    , `phone_work`
                    , `email`
                    , `roles`
                    , `password`
                    , `mailing_address_line1`
                    , `mailing_address_line2`
                    , `mailing_address_city`
                    , `mailing_address_state`
                    , `mailing_address_zip_code`
                    , `mailing_address_country`
                    , `physical_address_line1`
                    , `physical_address_line2`
                    , `physical_address_city`
                    , `physical_address_state`
                    , `physical_address_zip_code`
                    , `ip_address`
                    , `password_recovery_key`
                    , `password_recovery_date`
                    , `password_recovery_ip_address`
                    , `verification_key`
                    , `verification_date`
                    , `verification_ip_address`
                    , `has_started_registration`
                    , `is_verified`
                    , `is_registered`
                    , `agreed_to_terms_at`
                    , `terms_id`
                    , `updated_at`
                    , `created_at`
                    , `is_active`)
VALUES ( 6
       , NULL
       , 'Tom Olson - Admin'
       , 'Tom'
       , 'E'
       , 'Olson'
       , NULL
       , '281-236-2506'
       , '281-236-2506'
       , NULL
       , '281-256-2306'
       , 'tom@webtoaster.com'
       , '[
    "ROLE_SUPER_ADMIN"
  ]'
       , '$argon2id$v=19$m=65536,t=6,p=1$dElWUFZHcVd6YndHb2F1cw$vsuve9p8o4rIlRr+WcUg25Fzwpx/ZNnjUpU+M0JCRu0'
       , '1600 Pennsylvania Avenue'
       , NULL
       , 'Washington'
       , 'DC'
       , '22001'
       , 'US'
       , '1600 Pennsylvania Avenue'
       , NULL
       , 'Washington'
       , 'DC'
       , '22001'
       , '127.0.0.1'
       , NULL
       , NULL
       , NULL
       , '1431a41a056cf9745a332363015e0451'
       , '2019-07-15 09:49:52'
       , '127.0.0.1'
       , 1
       , 1
       , 1
       , '2019-07-15 09:49:52'
       , 1
       , '2019-07-15 09:49:51'
       , '2019-07-15 09:49:51'
       , 1);



SET FOREIGN_KEY_CHECKS = 1;





