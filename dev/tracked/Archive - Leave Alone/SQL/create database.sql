-- use information_schema;
DROP database if exists hoa
;

create database hoa;
use hoa;
SET FOREIGN_KEY_CHECKS = 0;
-- -----------------------------------------------------------------------------------------------------------------------
-- FINALIZED TABLES
-- FINALIZED TABLES
-- FINALIZED TABLES
-- FINALIZED TABLES
-- FINALIZED TABLES
-- FINALIZED TABLES
DROP TABLE if exists db_sessions
;

CREATE TABLE db_sessions
(
    session_id    VARCHAR(40),
    ip_address    VARCHAR(45)  DEFAULT '0' NOT NULL,
    user_agent    VARCHAR(120)             NOT NULL,
    last_activity INT UNSIGNED DEFAULT '0' NOT NULL,
    user_data     TEXT                     NOT NULL,
    PRIMARY KEY (session_id)
)
    DEFAULT CHARACTER SET utf8
    COLLATE utf8_general_ci
    ENGINE = INNODB
;

DROP TABLE if exists person
;

CREATE TABLE hoa.person
(
    person_id                 INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Person',
    name_display              VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Display Name',
    name_first                VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'First Name',
    name_middle               VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Middle Name',
    name_last                 VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Last Name',
    name_suffix               VARCHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Suffix',
    phone_home                CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT '',
    phone_mobile              CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT '',
    phone_fax                 CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT '',
    phone_work                CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT '',
    phone_work_extension      CHAR(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT '',
    email_address             VARCHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '',
    mailing_address_line1     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Mailing Address Line 1',
    mailing_address_line2     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Mailing Address Line 1',
    mailing_address_city      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Mailing Address City',
    mailing_address_state     CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT 'Mailing Address State',
    mailing_address_zip_code  CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT 'Mailing Address Zip Code',
    mailing_address_country   CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT 'Mailing Address Country Code',
    physical_address_line1    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_line2    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_city     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Physical Address City',
    physical_address_state    CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT 'Physical Address State',
    physical_address_zip_code CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT 'Physical Address Zip Code',
    updated_at                DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at                DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    is_active                 TINYINT UNSIGNED                                              DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (person_id),
    INDEX IDX_person_name_last (name_last),
    INDEX IDX_person_name_first (name_first),
    INDEX IDX_person_email_address (email_address),
    INDEX IDX_person_phone_mobile (phone_mobile)
)
    ENGINE = InnoDB COMMENT = 'Defines a Person'
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists company
;

CREATE TABLE hoa.company
(
    company_id                INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Company',
    company_name              CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Name of the Association',
    physical_address_line1    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_line2    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_city     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Physical Address City',
    physical_address_state    CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci   DEFAULT NULL COMMENT 'Physical Address State',
    physical_address_zip_code CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Physical Address Zip Code',
    mailing_address_line1     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Mailing Address Line 1',
    mailing_address_line2     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Mailing Address Line 1',
    mailing_address_city      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Mailing Address City',
    mailing_address_state     CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci   DEFAULT NULL COMMENT 'Mailing Address State',
    mailing_address_zip_code  CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Mailing Address Zip Code',
    billing_address_line1     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Billing Address Line 1',
    billing_address_line2     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Billing Address Line 1',
    billing_address_city      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Billing Address City',
    billing_address_state     CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci   DEFAULT NULL COMMENT 'Billing Address State',
    billing_address_zip_code  CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Billing Address Zip Code',
    is_active                 TINYINT UNSIGNED                                           DEFAULT '1' COMMENT 'Is record active',
    updated_at                DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at                DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    created_by_person_id      INT UNSIGNED                NOT NULL COMMENT 'Soft FK to Person',
    PRIMARY KEY (company_id),
    INDEX IDX_company_company_name (company_name),
    INDEX IDX_company_physical_address_zip_code (physical_address_zip_code),
    INDEX IDX_company_mailing_address_zip_code (mailing_address_zip_code),
    INDEX IDX_company_billing_address_zip_code (billing_address_zip_code)
)
    ENGINE = InnoDB COMMENT = 'Table for identifying company type entities.'
    AUTO_INCREMENT = 17
    INSERT_METHOD = LAST
    CHECKSUM = 1
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists association
;

CREATE TABLE hoa.association
(
    association_id       INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Association',
    company_id           INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Company',
    number_of_properties SMALLINT UNSIGNED DEFAULT NULL COMMENT 'Number of properties in this assocaition',
    is_active            TINYINT UNSIGNED  DEFAULT '1' COMMENT 'Is record active',
    updated_at           DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at           DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    PRIMARY KEY (association_id, company_id),
    INDEX FK_IDX_association_company_id (company_id),
    CONSTRAINT FK_association_to_company FOREIGN KEY (company_id) REFERENCES company (company_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'Table for the Asssociations'
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
;

DROP TABLE if exists hoa_staff_member
;

CREATE TABLE hoa.hoa_staff_member
(
    association_id INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    person_id      INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    job_title      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Descripton of off Job',
    is_active      TINYINT UNSIGNED                                           DEFAULT '1' COMMENT 'Is record active',
    updated_at     DATETIME     NOT NULL COMMENT 'TS When Updated',
    created_at     DATETIME     NOT NULL COMMENT 'TS when Inserted',
    PRIMARY KEY (association_id, person_id),
    INDEX FK_IDX_hoa_staff_member_association_id (association_id),
    INDEX FK_IDX_hoa_staff_member_person_id (person_id),
    CONSTRAINT FK_hoa_staff_member_to_association FOREIGN KEY (association_id) REFERENCES association (association_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_hoa_staff_member_to_person FOREIGN KEY (person_id) REFERENCES person (person_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'NN Table connecting People who work in the HOAs'
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists property
;

CREATE TABLE hoa.property
(
    property_id               INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Property',
    association_id            INT UNSIGNED                NOT NULL COMMENT 'Association',
    ext_hoa_property_id       CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Externally produced foreign key for association tracking',
    ext_cad_property_id       CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Externally produced foreign key for county appraisal district',
    physical_address_line1    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_line2    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_city     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Physical Address City',
    physical_address_state    CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT 'Physical Address State',
    physical_address_zip_code CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT 'Physical Address Zip Code',
    legal_lot                 CHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT 'Lot Number(s) from Legal Description',
    legal_section             CHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT 'Section Number(s) from Legal Description',
    legal_block               CHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT 'Block Number(s) from Legal Description',
    legal_description         VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Full Legal Description',
    updated_at                DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at                DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    is_active                 TINYINT UNSIGNED                                              DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (property_id, association_id),
    INDEX FK_IDX_property_association_id (association_id),
    INDEX IDX_property_ext_hoa_property_id (ext_hoa_property_id),
    INDEX IDX_property_ext_cad_property_id (ext_cad_property_id),
    CONSTRAINT FK_property_to_association FOREIGN KEY (association_id) REFERENCES association (association_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'Table Defining Property'
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists hoa.attorney
;

CREATE TABLE hoa.attorney
(
    person_id            INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    company_id           INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Company',
    license_number       CHAR(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Start Bar or License Number',
    date_license_expires DATE                                                      DEFAULT NULL COMMENT 'Date when license expires',
    updated_at           DATETIME     NOT NULL COMMENT 'TS when last updated',
    created_at           DATETIME     NOT NULL COMMENT 'TS when Inserted',
    is_active            TINYINT UNSIGNED                                          DEFAULT '1' COMMENT 'Is record active',
    sort_order           SMALLINT UNSIGNED                                         DEFAULT '0',
    PRIMARY KEY (person_id, company_id),
    INDEX FK_IDX_attorney_person_id (person_id),
    INDEX FK_IDX_attorney_company_id (company_id),
    CONSTRAINT FK_attorney_to_person FOREIGN KEY (person_id) REFERENCES person (person_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_attorney_to_company FOREIGN KEY (company_id) REFERENCES company (company_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'NN Table Defining Attorneys'
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists board_member
;

CREATE TABLE hoa.board_member
(
    association_id INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    person_id      INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    date_start     DATETIME     NOT NULL COMMENT 'TS When Updated',
    date_end       DATETIME     NOT NULL COMMENT 'TS When Updated',
    is_active      TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active',
    updated_at     DATETIME     NOT NULL COMMENT 'TS When Updated',
    created_at     DATETIME     NOT NULL COMMENT 'TS when Inserted',
    PRIMARY KEY (association_id, person_id),
    INDEX FK_IDX_board_member_association_id (association_id),
    INDEX FK_IDX_board_member_person_id (person_id),
    CONSTRAINT FK_board_member_to_association FOREIGN KEY (association_id) REFERENCES association (association_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_board_member_to_person FOREIGN KEY (person_id) REFERENCES person (person_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = ''
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
;

DROP TABLE if exists hoa.attorney_to_association
;

CREATE TABLE hoa.attorney_to_association
(
    attorney_person_id  INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Attorney',
    attorney_company_id INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Attorney',
    association_id      INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    updated_at          DATETIME     NOT NULL COMMENT 'TS when last updated',
    created_at          DATETIME     NOT NULL COMMENT 'TS when Inserted',
    is_active           TINYINT UNSIGNED  DEFAULT '1' COMMENT 'Is record active',
    sort_order          SMALLINT UNSIGNED DEFAULT '0',
    PRIMARY KEY (attorney_person_id, attorney_company_id, association_id),
    INDEX FK_IDX_attorney_to_association_person_id (attorney_person_id),
    INDEX FK_IDX_attorney_to_association_association_id (attorney_company_id),
    INDEX FK_IDX_attorney_to_association_company_id (association_id),
    CONSTRAINT FK_attorney_to_association_to_person FOREIGN KEY (attorney_person_id) REFERENCES attorney (person_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_attorney_to_association_to_company FOREIGN KEY (attorney_company_id) REFERENCES attorney (company_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_attorney_to_association_to_association FOREIGN KEY (association_id) REFERENCES association (association_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'NN Table Defining Attorneys'
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists owner
;

CREATE TABLE hoa.owner
(
    -- owner_id        INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Owner'               ,
    person_id            INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person.',
    property_id          INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Property.',
    updated_by_person_id INT UNSIGNED     DEFAULT NULL COMMENT 'Soft Foreign Key to Person.  Person who updated the data.  On insert, it is the same as created.',
    created_by_person_id INT UNSIGNED     DEFAULT NULL COMMENT 'Soft Foreign Key to Person.  Person who imported the data.',
    updated_at           DATETIME     NOT NULL COMMENT 'TS When Updated',
    created_at           DATETIME     NOT NULL COMMENT 'TS when Inserted',
    is_active            TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (person_id, property_id),
    CONSTRAINT FK_owner_to_person FOREIGN KEY (person_id) REFERENCES person (person_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_owner_to_property FOREIGN KEY (property_id) REFERENCES property (property_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'Property Owners table.  Once owners are verified, then they become voters by the manager of the election.'
    INSERT_METHOD = LAST
    CHECKSUM = 1
;

DROP TABLE if exists hoa.person_to_association
;

CREATE TABLE hoa.person_to_association
(
    person_id         INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person',
    association_id    INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Association',
    ext_hoa_person_id CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Externally produced foreign key for association tracking',
    updated_at        DATETIME     NOT NULL COMMENT 'TS when last updated',
    created_at        DATETIME     NOT NULL COMMENT 'TS when Inserted',
    is_active         TINYINT UNSIGNED                                           DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (person_id, association_id),
    INDEX FK_IDX_person_to_association_person_id (person_id),
    INDEX FK_IDX_person_to_association_association_id (association_id),
    CONSTRAINT FK_person_to_association_to_person FOREIGN KEY (person_id) REFERENCES person (person_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_person_to_association_to_association FOREIGN KEY (association_id) REFERENCES association (association_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'NN Table Defining Links between a Person and an Association'
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
;

DROP TABLE if exists login
;

CREATE TABLE hoa.login
(
    login_id       INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Login',
    person_id      INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Person',
    un             CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Username',
    pw             CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Password for Person',
    date_pw_starts DATETIME                    NOT NULL COMMENT 'Date when Password Starts',
    date_pw_ends   DATETIME                                                   DEFAULT NULL COMMENT 'Date when Password Expires',
    updated_at     DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at     DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    is_active      TINYINT UNSIGNED                                           DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (login_id, person_id),
    INDEX FK_IDX_login_person_id (person_id),
    INDEX IDX_login_un (un),
    INDEX IDX_login_pw (pw),
    CONSTRAINT FK_login_to_person FOREIGN KEY (person_id) REFERENCES person (person_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = ''
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists election_type
;

CREATE TABLE hoa.election_type
(
    election_type_id   INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Election_Type',
    election_type      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Descripton of Election',
    url_election_type  CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'URL link to get to page describing the election',
    html_election_type TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT 'HTML Describing the Election Type',
    is_active          TINYINT UNSIGNED                                           DEFAULT '1' COMMENT 'Is record active',
    updated_at         DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at         DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    PRIMARY KEY (election_type_id)
)
    ENGINE = InnoDB COMMENT = ''
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists ballot_type
;

CREATE TABLE hoa.ballot_type
(
    ballot_type_id   INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Ballot_Type',
    ballot_type      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Description of a ballot type.  ie, electronic, proxy, etc.',
    url_ballot_type  CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'URL link to get to page describing the Ballot Type',
    html_ballot_type TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT 'HTML Describing the Ballot Type',
    is_active        TINYINT UNSIGNED                                           DEFAULT '1' COMMENT 'Is record active',
    updated_at       DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at       DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    PRIMARY KEY (ballot_type_id)
)
    ENGINE = InnoDB COMMENT = 'Contains the Type of Ballots'
    AUTO_INCREMENT = 10
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists election
;

CREATE TABLE hoa.election
(
    election_id                      INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Election',
    association_id                   INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Association',
    election_type_id                 INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Election_Type',
    ballot_type_id                   INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Ballot_Type',
    election_name_heading            CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Line 1 Text to Describe the Election',
    election_name_subheading         CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Line 2 Text to Describe the Election',
    url_election                     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'URL link to get to page describing the election',
    html_election_information        TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT 'HTML Describing the Election',
    ballot_physical_address_line1    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Physical Address Line 1',
    ballot_physical_address_line2    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Physical Address Line 1',
    ballot_physical_address_city     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Physical Address City',
    ballot_physical_address_state    CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci   DEFAULT NULL COMMENT 'Physical Address State',
    ballot_physical_address_zip_code CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Physical Address Zip Code',
    ballot_mailing_address_line1     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Mailing Address Line 1',
    ballot_mailing_address_line2     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Mailing Address Line 1',
    ballot_mailing_address_city      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Mailing Address City',
    ballot_mailing_address_state     CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci   DEFAULT NULL COMMENT 'Mailing Address State',
    ballot_mailing_address_zip_code  CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Mailing Address Zip Code',
    date_start                       DATETIME                    NOT NULL COMMENT 'Date and Time when voting starts',
    date_end                         DATETIME                    NOT NULL COMMENT 'Date and Time when voting ends',
    updated_at                       DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at                       DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    is_active                        TINYINT UNSIGNED                                           DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (election_id, association_id, election_type_id, ballot_type_id),
    INDEX FK_IDX_election_association_id (association_id),
    INDEX FK_IDX_election_election_type_id (election_type_id),
    INDEX FK_IDX_election_ballot_type_id (ballot_type_id),
    INDEX IDX_election_date_start (date_start),
    INDEX IDX_election_date_end (date_end),
    CONSTRAINT FK_election_to_association FOREIGN KEY (association_id) REFERENCES association (association_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_election_to_election_type FOREIGN KEY (election_type_id) REFERENCES election_type (election_type_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_election_to_ballot_type FOREIGN KEY (ballot_type_id) REFERENCES ballot_type (ballot_type_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = ''
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists election_date
;

CREATE TABLE hoa.election_date
(
    election_date_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Ellection_Date',
    election_id      INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Election',
    date_value       DATETIME                    NOT NULL COMMENT 'Date to Display',
    date_label       char(128)                   NOT NULL COMMENT 'Label to Display with Date',
    is_template      TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active',
    updated_at       DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at       DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    is_active        TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (election_date_id, election_id),
    INDEX FK_IDX_election_date_election_id (election_id),
    CONSTRAINT FK_election_date_to_election FOREIGN KEY (election_id) REFERENCES election (election_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = ''
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists voter
;

CREATE TABLE hoa.voter
(
    voter_id             INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Voter',
    person_id            INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Owner',
    property_id          INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Owner',
    election_id          INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Election',
    is_proxy             TINYINT UNSIGNED DEFAULT '0' COMMENT 'Is this voter a proxy for another homeowner?',
    proxy_person_id      INT UNSIGNED     DEFAULT NULL COMMENT 'Foreign Key to Person defining who the proxy is.',
    -- election_association_id   INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Election'                            ,
    -- election_election_type_id INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Election'                            ,
    updated_by_person_id INT UNSIGNED     DEFAULT NULL COMMENT 'Soft Foreign Key to Person.  Person who updated the data.  On insert, it is the same as created.',
    created_by_person_id INT UNSIGNED     DEFAULT NULL COMMENT 'Soft Foreign Key to Person.  Person who imported the data.',
    updated_at           DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at           DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    is_active            TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (voter_id, person_id, property_id, election_id),
    INDEX FK_IDX_voter_proxy_person_id (proxy_person_id),
    INDEX IDX_voter_updated_by_id (updated_by_person_id),
    INDEX IDX_voter_created_by_id (created_by_person_id),
    -- INDEX FK_IDX_voter_election_election_id (election_election_id)                         ,
    CONSTRAINT FK_voter_to_person FOREIGN KEY (person_id) REFERENCES person (person_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_voter_to_property FOREIGN KEY (property_id) REFERENCES property (property_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_voter_to_election FOREIGN KEY (election_id) REFERENCES election (election_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT


    -- ,
    -- CONSTRAINT FK_voter_to_proxy_person FOREIGN KEY (proxy_person_id) REFERENCES person (person_id)
    -- ON
    -- DELETE
    -- NO ACTION
    -- ON
    -- UPDATE
    -- NO ACTION
)
    ENGINE = InnoDB COMMENT = 'Table defines the voters in an election.'
    AUTO_INCREMENT = 1
    INSERT_METHOD = LAST
    CHECKSUM = 1
;

-- -----------------------------------------------------------------------------------------------------------------------
-- -----------------------------------------------------------------------------------------------------------------------
-- -----------------------------------------------------------------------------------------------------------------------
-- -----------------------------------------------------------------------------------------------------------------------
-- -----------------------------------------------------------------------------------------------------------------------
-- NOT FINALIZED
-- NOT FINALIZED
-- NOT FINALIZED
-- NOT FINALIZED
-- NOT FINALIZED
-- NOT FINALIZED
-- NOT FINALIZED
-- NOT FINALIZED
-- NOT FINALIZED
-- DROP TABLE if exists _candidate
-- ;
-- Becomes place for Paper Ballots
DROP TABLE if exists candidate
;

CREATE TABLE hoa.candidate
(
    candidate_id             INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Candidate',
    election_id              INT UNSIGNED                NOT NULL COMMENT 'FOREIGN Key to Election',
    is_write_in              TINYINT UNSIGNED                                              DEFAULT '0' COMMENT 'Is record active',
    write_in_by_voter_id     INT UNSIGNED                                                  DEFAULT NULL COMMENT 'FOREIGN Key to Voter',
    name_display             VARCHAR(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Display Name',
    name_first               VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'First Name',
    name_middle              VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Middle Name',
    name_last                VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Last Name',
    name_suffix              VARCHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL COMMENT 'Suffix',
    display_address_line1    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Mailing Address Line 1',
    display_address_line2    CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Mailing Address Line 1',
    display_address_city     CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci    DEFAULT NULL COMMENT 'Mailing Address City',
    display_address_state    CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      DEFAULT NULL COMMENT 'Mailing Address State',
    display_address_zip_code CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci     DEFAULT NULL COMMENT 'Mailing Address Zip Code',
    show_address             TINYINT UNSIGNED                                              DEFAULT '0' COMMENT 'Display the candidates address?',
    share_write_in_name      TINYINT UNSIGNED                                              DEFAULT '0' COMMENT 'Does the Voter want to share the name of the write in they have entered?',
    updated_at               DATETIME                    NOT NULL COMMENT 'TS When Updated',
    created_at               DATETIME                    NOT NULL COMMENT 'TS when Inserted',
    is_active                TINYINT UNSIGNED                                              DEFAULT '1' COMMENT 'Is record active',
    PRIMARY KEY (candidate_id),
    INDEX FK_IDX_candidate_election_id (election_id),
    INDEX IDX_candidate_name_last (name_last),
    INDEX IDX_candidate_name_display (name_display),
    CONSTRAINT FK_candidate_to_election_id FOREIGN KEY (election_id) REFERENCES election (election_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'Defines the cadidates for the election.'
    AUTO_INCREMENT = 3
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;

DROP TABLE if exists ballot
;

CREATE TABLE hoa.ballot
(
    ballot_id         INT UNSIGNED NOT NULL                                      DEFAULT 10000 COMMENT 'Primary Key for Ballot, NOT Autoincrmented',
    voter_id          INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Voter',
    candidate_id      INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Candidate',
    ballot_type_id    INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Ballot_Type',
    url_online_ballot CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'URL link to get to online ballot',
    url_paper_ballot  CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'URL link to get to PDF Ballot ',
    uri_paper_trace   CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'URL link to get to the hard copy of the ballot',
    is_active         TINYINT UNSIGNED                                           DEFAULT '1' COMMENT 'Is record active',
    updated_at        DATETIME     NOT NULL COMMENT 'TS When Updated',
    created_at        DATETIME     NOT NULL COMMENT 'TS when Inserted',
    PRIMARY KEY (voter_id, candidate_id),
    UNIQUE INDEX IDX_ballot_ballot_id (ballot_id),
    INDEX FK_IDX_ballot_election_id (voter_id),
    INDEX FK_IDX_ballot_ballot_type_id (ballot_type_id),
    INDEX FK_IDX_ballot_candidate_id (candidate_id),
    CONSTRAINT FK_ballot_to_candidate FOREIGN KEY (candidate_id) REFERENCES candidate (candidate_id) ON
        DELETE
        RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_ballot_to_voter FOREIGN KEY (voter_id) REFERENCES voter (voter_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT,
    CONSTRAINT FK_ballot_to_ballot_type FOREIGN KEY (ballot_type_id) REFERENCES ballot_type (ballot_type_id)
        ON
            DELETE
            RESTRICT
        ON
            UPDATE
            RESTRICT
)
    ENGINE = InnoDB COMMENT = 'Contains Ballots for an election.  There will be one ballot per owner.'
    AUTO_INCREMENT = 9
    INSERT_METHOD = LAST
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
;


DELIMITER ;


DROP TRIGGER IF EXISTS tr_nextval_ballot;

delimiter //

CREATE TRIGGER tr_nextval_ballot
    BEFORE INSERT
    ON ballot
    FOR EACH ROW
BEGIN
    DECLARE max_ballot_id INT;

    SELECT max(ballot_id) INTO max_ballot_id FROM ballot;


    IF NEW.ballot_id = 10000
    THEN
        SET NEW.ballot_id = max_ballot_id + 1;
    END IF;
END;
//
DELIMITER ;


/*
DROP PROCEDURE if exists sp_nextval_ballot	;

DELIMITER $$
CREATE PROCEDURE
    sp_nextval_ballot ()
BEGIN
    DECLARE max_ballot_id INT;
    SELECT
        max(ballot_id)
    INTO
        max_ballot_id
    FROM
        ballot
    ;

    IF max_ballot_id IS NOT NULL
        THEN
        UPDATE
            hoa.ballot
        SET ballot.ballot_id = max_val + 1
        WHERE
            ballot.ballot_id = 10000
        ;

    ELSE
        UPDATE
            hoa.ballot
        SET ballot.ballot_id = 10001
        WHERE
            ballot.ballot_id IS NULL
        ;

    END IF;
END
$$
DELIMITER ;
 */


/*
DROP TABLE if exists candidate_declared
;
CREATE TABLE hoa.candidate_declared
(
candidate_declared_id  INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Candidate_Declared'                                ,
election_id            INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Election'                                                          ,
person_id              INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person'                                                            ,
url_candidate_profile  CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'URL for the Candidates Profile' ,
html_candidate_profile TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'HTML for the Candidates Profile'     ,
is_active              TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active'                                                          ,
updated_at             DATETIME NOT NULL COMMENT 'TS When Updated'                                                                      ,
created_at             DATETIME NOT NULL COMMENT 'TS when Inserted'                                                                     ,
PRIMARY KEY (candidate_declared_id, election_id, person_id)                                                                             ,
INDEX FK_IDX_candidate_declared_election_id (election_id)                                                                               ,
INDEX FK_IDX_candidate_declared_person_id (person_id)                                                                                   ,
CONSTRAINT FK_candidate_declared_to_person FOREIGN KEY (person_id) REFERENCES person (person_id) ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT,
CONSTRAINT FK_candidate_declared_to_election FOREIGN KEY (election_id) REFERENCES election (election_id)
ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT
)
ENGINE = InnoDB COMMENT = 'Contains links to the candidates' AUTO_INCREMENT = 3 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
;
DROP TABLE if exists candidate_write_in
;
CREATE TABLE hoa.candidate_write_in
(
candidate_write_in_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Ballot_Candidate'                                                    ,
election_id           INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Election'                                                                            ,
owner_id              INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Owner'                                                                               ,
proxy_person_id       INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Owner'                                                                               ,
candidate_name        CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Name submitted to election as write in candidate' ,
is_active             TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active'                                                                            ,
updated_at            DATETIME NOT NULL COMMENT 'TS When Updated'                                                                                        ,
created_at            DATETIME NOT NULL COMMENT 'TS when Inserted'                                                                                       ,
PRIMARY KEY (candidate_write_in_id)                                                                                                                      ,
INDEX FK_IDX_candidate_write_in_election_id (election_id)                                                                                                ,
INDEX FK_IDX_candidate_write_in_owner_id (owner_id)                                                                                                      ,
CONSTRAINT FK_candidate_write_in_to_election FOREIGN KEY (election_id) REFERENCES election (election_id)
)
ENGINE = InnoDB COMMENT = 'Names of Write In Candidates' AUTO_INCREMENT = 9 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
;
*/
/* DROP TABLE if exists ballot_candidate
;
CREATE TABLE hoa.ballot_candidate
(
ballot_candidate_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Ballot_Candidate' ,
election_id         INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Election'                         ,
candidate_id        INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Candidate'                        ,
is_active           TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active'                         ,
updated_at          DATETIME NOT NULL COMMENT 'TS When Updated'                                     ,
created_at          DATETIME NOT NULL COMMENT 'TS when Inserted'                                    ,
PRIMARY KEY (ballot_candidate_id, election_id, candidate_id)                                        ,
INDEX FK_IDX_ballot_candidate_election_id (election_id)                                             ,
INDEX FK_IDX_ballot_candidate_candidate_id (candidate_id)                                           ,
CONSTRAINT FK_ballot_candidate_to_election FOREIGN KEY (election_id) REFERENCES election (election_id) ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT ,
CONSTRAINT FK_ballot_candidate_to_candidate FOREIGN KEY (candidate_id) REFERENCES candidate (candidate_id)
ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT
)
ENGINE = InnoDB COMMENT = 'Contains declared candidates for an election to appear on all ballots.' AUTO_INCREMENT = 9 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
;
DROP TABLE if exists ballot_write_in_candidate
;
CREATE TABLE hoa.ballot_write_in_candidate
(
ballot_write_in_candidate_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Ballot_Candidate'                                                    ,
ballot_id                    INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Ballot'                                                                              ,
candidate_name               CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Name submitted to election as write in candidate' ,
is_active                    TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active'                                                                            ,
updated_at                   DATETIME NOT NULL COMMENT 'TS When Updated'                                                                                        ,
created_at                   DATETIME NOT NULL COMMENT 'TS when Inserted'                                                                                       ,
PRIMARY KEY (ballot_write_in_candidate_id, ballot_id)
)
ENGINE = InnoDB COMMENT = 'Names of Write In Candidates' AUTO_INCREMENT = 9 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
;
DROP TABLE if exists ballot_to_write_in_candidate
;
CREATE TABLE hoa.ballot_to_write_in_candidate
(
ballot_to_write_in_candidate_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for ballot_to_write_in_candidate' ,
ballot_id                       INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Ballot'                                       ,
ballot_write_in_candidate_id    INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Ballot_Write_In_Candidate'                    ,
is_active                       TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active'                                     ,
updated_at                      DATETIME NOT NULL COMMENT 'TS When Updated'                                                 ,
created_at                      DATETIME NOT NULL COMMENT 'TS when Inserted'                                                ,
PRIMARY KEY (ballot_to_write_in_candidate_id, ballot_id, ballot_write_in_candidate_id)                                      ,
INDEX FK_IDX_ballot_to_write_in_candidate_ballot_id (ballot_id)                                                             ,
INDEX FK_IDX_ballot_to_write_in_candidate_ballot_write_in_candidate_id (ballot_write_in_candidate_id)                       ,
CONSTRAINT FK_ballot_to_write_in_candidate_to_ballot FOREIGN KEY (ballot_id) REFERENCES ballot (ballot_id) ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT ,
CONSTRAINT FK_ballot_to_write_in_candidate_to_ballot_write_in_candidate FOREIGN KEY (ballot_write_in_candidate_id) REFERENCES ballot_write_in_candidate (ballot_write_in_candidate_id)
ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT
)
ENGINE = InnoDB COMMENT = 'NN Table for Connecting Ballots to Write In Candidates' AUTO_INCREMENT = 1 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
;
*/
/* DROP TABLE if exists vote
;
CREATE TABLE hoa.vote
(
vote_id      INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Vote' ,
ballot_id    INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Ballot'                   ,
owner_id     INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Owner'                ,
candidate_id INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Candidate'            ,
is_active    TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active'              ,
updated_at   DATETIME NOT NULL COMMENT 'TS When Updated'                             ,
created_at   DATETIME NOT NULL COMMENT 'TS when Inserted'                            ,
PRIMARY KEY (vote_id, ballot_id, owner_id, candidate_id)                             ,
INDEX FK_IDX_vote_ballot_id (ballot_id)                                              ,
INDEX FK_IDX_vote_owner_id (owner_id)                                                ,
INDEX FK_IDX_vote_candidate_id (candidate_id)                                        ,
CONSTRAINT FK_vote_to_ballot FOREIGN KEY (ballot_id) REFERENCES ballot (ballot_id) ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT ,
CONSTRAINT FK_vote_to_owner FOREIGN KEY (owner_id) REFERENCES owner (owner_id)
ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT ,
CONSTRAINT FK_vote_to_candidate FOREIGN KEY (candidate_id) REFERENCES candidate (candidate_id)
ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT
)
ENGINE = InnoDB COMMENT = '' AUTO_INCREMENT = 9 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
; */
/*  DROP TABLE if exists ballot_template
;
CREATE TABLE hoa.ballot_template
(
ballot_template_id INT  UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Entity'            ,
election_type      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '' ,
is_active             TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is record active'                          ,
updated_at         DATETIME NOT NULL COMMENT 'TS When Updated'                                      ,
created_at        DATETIME NOT NULL COMMENT 'TS when Inserted'                                     ,
PRIMARY KEY (ballot_template_id)
)
ENGINE = InnoDB COMMENT = '' AUTO_INCREMENT = 3 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
; */
/*
DROP TABLE if exists ballot_link_tracking
;
CREATE TABLE hoa.ballot_link_tracking
(
ballot_link_tracking_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Ballot_Link' ,
ballot_id               INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Ballot'                      ,
person_id               INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person'                      ,
login_id                INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Login'                       ,
fromipaddress           CHAR(15) NOT NULL COMMENT 'IP Address from where the click originated'     ,
date_clicked            DATETIME NOT NULL COMMENT 'Date and Time when the click through occured'   ,
created_at              DATETIME NOT NULL COMMENT 'TS when Inserted'                               ,
PRIMARY KEY (ballot_link_tracking_id, ballot_id,person_id)                                         ,
INDEX FK_IDX_ballot_link_tracking_ballot_id (ballot_id)                                            ,
INDEX FK_IDX_ballot_link_tracking_person_id (person_id)                                            ,
INDEX FK_IDX_ballot_link_tracking_login_id (login_id)                                              ,
CONSTRAINT FK_ballot_link_tracking_to_ballot FOREIGN KEY (ballot_id) REFERENCES ballot (ballot_id) ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT ,
CONSTRAINT FK_ballot_link_tracking_to_person FOREIGN KEY (person_id) REFERENCES person (person_id)
ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT ,
CONSTRAINT FK_ballot_link_tracking_to_login FOREIGN KEY (login_id) REFERENCES login (login_id)
ON
DELETE
RESTRICT
ON
UPDATE
RESTRICT
)
ENGINE = InnoDB COMMENT = 'Tracks links clicked upon' AUTO_INCREMENT = 1 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
; */
/*  DROP TABLE if exists election_role
;
CREATE TABLE hoa.election_role
(
election_role_id   INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Ballot_Type'                                                    ,
election_role      CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Description of the Role'                     ,
url_election_role  CHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'URL link to get to page describing the Role' ,
html_election_role TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'HTML Describing the Role Type'                    ,
is_active          TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active'                                                                       ,
updated_at         DATETIME NOT NULL COMMENT 'TS When Updated'                                                                                   ,
created_at         DATETIME NOT NULL COMMENT 'TS when Inserted'                                                                                  ,
PRIMARY KEY (election_role_id)
)
ENGINE = InnoDB COMMENT = 'Contains the Type of Security Roles in an Election' AUTO_INCREMENT = 10 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
; */
/* DROP TABLE if exists election_security
;
CREATE TABLE hoa.election_security
(
election_security_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Election_Security'                         ,
election_id          INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Election'                                                  ,
association_id       INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Association'                                               ,
election_role_id     INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Election_Role'                                             ,
granted_to_person_id INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person'                                                    ,
granted_by_person_id INT UNSIGNED NOT NULL COMMENT 'Foreign Key to Person'                                                    ,
date_expires         DATETIME DEFAULT NULL COMMENT 'When this right expires'                                                  ,
updated_at           DATETIME NOT NULL COMMENT 'TS When Updated'                                                              ,
created_at           DATETIME NOT NULL COMMENT 'TS when Inserted'                                                             ,
is_active            TINYINT UNSIGNED DEFAULT '1' COMMENT 'Is record active'                                                  ,
PRIMARY KEY (election_security_id, election_id, association_id, election_role_id, granted_to_person_id, granted_by_person_id) ,
INDEX FK_IDX_election_permission_election_id (election_id)                                                                    ,
INDEX FK_IDX_election_permission_association_id (association_id)                                                              ,
INDEX FK_IDX_election_permission_election_role_id (election_role_id)                                                          ,
INDEX FK_IDX_election_permission_granted_to_person_id (granted_to_person_id)                                                  ,
INDEX FK_IDX_election_permission_granted_by_person_id (granted_by_person_id)                                                  ,
INDEX IDX_election_permission_date_expires (date_expires)                                                                     ,
CONSTRAINT FK_election_security_to_election FOREIGN KEY (election_id) REFERENCES election (election_id)                       ,
CONSTRAINT FK_election_security_to_association FOREIGN KEY (association_id) REFERENCES association (association_id)           ,
CONSTRAINT FK_election_security_to_election_role FOREIGN KEY (election_role_id) REFERENCES election_role (election_role_id)   ,
CONSTRAINT FK_election_security_to_person_granted_by FOREIGN KEY (granted_to_person_id) REFERENCES person (person_id)         ,
CONSTRAINT FK_election_security_to_person_granted_to FOREIGN KEY (granted_by_person_id) REFERENCES person (person_id)
)
ENGINE = InnoDB COMMENT = 'Table defines Permissions within the application' AUTO_INCREMENT = 7 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
; */
-- DROP TABLE if exists election_matrix
-- ;
-- CREATE TABLE hoa.election_matrix
-- (
-- election_matrix_id    INT  UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Election_Matrix' ,
-- election_id           INT  UNSIGNED NOT NULL COMMENT 'Foreign Key to Election'                        ,
-- association_id        INT  UNSIGNED NOT NULL COMMENT 'Foreign Key to Association'                     ,
-- election_owner_id     INT  UNSIGNED NOT NULL COMMENT 'Foreign Key to Person'                          ,
-- election_attorney_id  INT  UNSIGNED NOT NULL COMMENT 'Foreign Key to Attorney'                        ,
-- management_company_id INT  UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to Management_Company'          ,
-- is_owner              TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is Property Owner'                       ,
-- is_hoa_staff          TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is User an HOA Staff Member'             ,
-- is_election_staff     TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is User an Election Staff Member'        ,
-- is_election_su        TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is Election Super User'                  ,
-- is_app_staff          TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is App Staff'                            ,
-- is_app_admin          TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is App Administrator'                    ,
-- is_app_su             TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is App Super User'                       ,
-- updated_at            DATETIME NOT NULL COMMENT 'TS When Updated'                                    ,
-- created_at            DATETIME NOT NULL COMMENT 'TS when Inserted'                                   ,
-- is_active                TINYINT  UNSIGNED DEFAULT '1' COMMENT 'Is record active'                        ,
-- PRIMARY KEY (election_matrix_id,, election_id, association_id)                                       ,
-- INDEX FK_IDX_permission_election_id (election_id)                                                    ,
-- INDEX FK_IDX_permission_person_id (person_id)                                                        ,
-- INDEX FK_IDX_permission_owner_id (owner_id)                                                          ,
-- CONSTRAINT FK_permission_to_election FOREIGN KEY (election_id) REFERENCES election (election_id) ON
-- DELETE
-- RESTRICT
-- ON
-- UPDATE
-- RESTRICT,
-- CONSTRAINT FK_permission_to_person FOREIGN KEY (person_id) REFERENCES person (person_id)
-- ON
-- DELETE
-- RESTRICT
-- ON
-- UPDATE
-- RESTRICT
-- )
-- ENGINE = InnoDB COMMENT = 'Table defines Permissions within the application' AUTO_INCREMENT = 7 INSERT_METHOD = LAST CHECKSUM = 1 ROW_FORMAT = DYNAMIC CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
-- ;
SET FOREIGN_KEY_CHECKS = 1;
		