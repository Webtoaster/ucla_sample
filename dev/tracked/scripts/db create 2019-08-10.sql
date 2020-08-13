USE information_schema
;

DROP DATABASE IF EXISTS hoa
;

CREATE DATABASE hoa
;

USE hoa
;



DROP FUNCTION IF EXISTS proper
;

SET GLOBAL log_bin_trust_function_creators = TRUE
;
DELIMITER |

CREATE FUNCTION proper(str VARCHAR(128))
    RETURNS VARCHAR(128)
BEGIN
    DECLARE c CHAR(1);
    DECLARE s VARCHAR(128);
    DECLARE i INT DEFAULT 1;
    DECLARE bool INT DEFAULT 1;
    DECLARE punct CHAR(17) DEFAULT ' ()[]{},.-_!@;:?/';
    SET s = LCASE(str);

    WHILE i <= LENGTH(str)
        DO
            BEGIN
                SET c = SUBSTRING(
                        s
                    , i
                    , 1);

                IF LOCATE(
                           c
                       , punct) > 0
                THEN
                    SET bool = 1;
                ELSEIF bool = 1
                THEN
                    BEGIN
                        IF c >= 'a' AND
                           c <= 'z'
                        THEN
                            BEGIN
                                SET s = CONCAT(
                                        LEFT(
                                                s
                                            , i - 1)
                                    , UCASE(c)
                                    , SUBSTRING(
                                                s
                                            , i + 1));
                                SET bool = 0;
                            END;
                        ELSEIF c >= '0' AND
                               c <= '9'
                        THEN
                            SET bool = 0;
                        END IF;
                    END;
                END IF;

                SET i = i + 1;
            END;
        END WHILE;

    RETURN s;
END
;

|

DELIMITER ;


SET FOREIGN_KEY_CHECKS = 0
;

-- DDL -----------------------------------------------------------------------------
-- DDL -----------------------------------------------------------------------------
-- DDL -----------------------------------------------------------------------------
-- DDL -----------------------------------------------------------------------------


CREATE TABLE association
(
    association_id  INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for association',
    company_id      INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for company',
    created_from_ip VARCHAR(45)  DEFAULT NULL,
    updated_from_ip VARCHAR(45)  DEFAULT NULL,
    created_at      DATETIME                    NOT NULL,
    updated_at      DATETIME                    NOT NULL,
    is_active       TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX fk_idx_association_to_company (company_id),
    PRIMARY KEY (association_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE association_staff
(
    association_staff_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for table',
    association_id       INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for association',
    person_id            INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for person',
    is_attorney          TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'flag if staff member is attorney',
    job_title            CHAR(128)    DEFAULT NULL COMMENT 'descripton of off job',
    is_board_member      TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Is this Staff Member a Board Member',
    date_start           DATETIME     DEFAULT NULL,
    date_end             DATETIME     DEFAULT NULL,
    created_from_ip      VARCHAR(45)  DEFAULT NULL,
    updated_from_ip      VARCHAR(45)  DEFAULT NULL,
    created_at           DATETIME                    NOT NULL,
    updated_at           DATETIME                    NOT NULL,
    is_active            TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX fk_idx_association_staff_member_to_person (person_id),
    INDEX fk_idx_association_staff_member_to_association (association_id),
    PRIMARY KEY (association_staff_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE association_staff_permission
(
    association_staff_permission_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for table',
    association_staff_id            INT UNSIGNED                NOT NULL COMMENT 'Primary Key for table',
    permission_id                   INT UNSIGNED                NOT NULL COMMENT 'Primary Key for Permission',
    created_from_ip                 VARCHAR(45) DEFAULT NULL,
    updated_from_ip                 VARCHAR(45) DEFAULT NULL,
    created_at                      DATETIME                    NOT NULL,
    updated_at                      DATETIME                    NOT NULL,
    is_active                       TINYINT(1)  DEFAULT '1'     NOT NULL COMMENT 'Is record active',
    INDEX fk_idx_association_staff_permission_to_permission (permission_id),
    INDEX fk_idx_association_staff_permission_to_associationStaff (association_staff_id),
    PRIMARY KEY (association_staff_permission_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE ballot
(
    ballot_id        INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for ballot.',
    race_id          INT UNSIGNED                NOT NULL COMMENT 'Primary Key for Race',
    election_id      INT UNSIGNED                NOT NULL COMMENT 'Primary Key for election',
    owner_id         INT UNSIGNED                NOT NULL COMMENT 'Primary Key for Owner',
    proxy_id         INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Owner',
    ballot_status_id INT UNSIGNED                NOT NULL COMMENT 'Primary Key for Ballot Status',
    proxy_status_id  INT UNSIGNED                NOT NULL COMMENT 'Primary Key for Proxy Status',
    property_id      INT UNSIGNED                NOT NULL COMMENT 'Primary Key for property',
    proxy_key        VARCHAR(32)  DEFAULT NULL,
    created_from_ip  VARCHAR(45)  DEFAULT NULL,
    updated_from_ip  VARCHAR(45)  DEFAULT NULL,
    created_at       DATETIME                    NOT NULL,
    updated_at       DATETIME                    NOT NULL,
    is_active        TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX idx_ballot_race_id (race_id),
    INDEX idx_ballot_election_id (election_id),
    INDEX idx_ballot_owner_id (owner_id),
    INDEX idx_ballot_ballot_status_id (ballot_status_id),
    INDEX idx_ballot_proxy_id (proxy_id),
    INDEX idx_ballot_proxy_status_id (proxy_status_id),
    INDEX idx_ballot_property_id (property_id),
    PRIMARY KEY (ballot_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE ballot_status
(
    ballot_status_id         INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Ballot Status',
    description_short        CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display the Long Description',
    sort_order               INT UNSIGNED DEFAULT 100000 COMMENT 'Order of Display',
    created_from_ip          VARCHAR(45)  DEFAULT NULL,
    updated_from_ip          VARCHAR(45)  DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    PRIMARY KEY (ballot_status_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE company
(
    company_id                INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for company',
    person_id                 INT UNSIGNED DEFAULT NULL COMMENT 'Pseudo Foreign Key to Person, because this Company is the master to a User',
    number_of_sections        INT UNSIGNED DEFAULT NULL COMMENT 'Number of sub-sections of the Associations.',
    number_of_properties      INT UNSIGNED DEFAULT NULL COMMENT 'Number of properties in this Association',
    is_management_company     TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Is current Record representing a Management Company',
    is_association_company    TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Is current Record representing an HOA',
    name_formal               VARCHAR(180) DEFAULT NULL COMMENT 'Formal/Formal Name',
    physical_address_line1    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city     CHAR(128)    DEFAULT NULL COMMENT 'physical address city',
    physical_address_state    CHAR(2)      DEFAULT NULL COMMENT 'physical address state',
    physical_address_zip_code CHAR(16)     DEFAULT NULL COMMENT 'physical address zip code',
    display_physical_address  TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Display the Physical Address?',
    mailing_address_line1     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city      CHAR(128)    DEFAULT NULL COMMENT 'mailing address city',
    mailing_address_state     CHAR(2)      DEFAULT NULL COMMENT 'mailing address state',
    mailing_address_zip_code  CHAR(16)     DEFAULT NULL COMMENT 'mailing address zip code',
    mailing_address_country   CHAR(2)      DEFAULT NULL COMMENT 'mailing address country code',
    display_mailing_address   TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Display the Mailing Address?',
    billing_address_line1     CHAR(128)    DEFAULT NULL COMMENT 'Billing Address line 1',
    billing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'Billing Address line 1',
    billing_address_city      CHAR(128)    DEFAULT NULL COMMENT 'Billing Address city',
    billing_address_state     CHAR(2)      DEFAULT NULL COMMENT 'Billing Address state',
    billing_address_zip_code  CHAR(16)     DEFAULT NULL COMMENT 'Billing Address zip code',
    display_billing_address   TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Display the Billing Address?',
    phone_work                CHAR(14)     DEFAULT NULL,
    phone_fax                 CHAR(14)     DEFAULT NULL,
    url                       VARCHAR(256) DEFAULT NULL COMMENT 'Web Site address',
    created_from_ip           VARCHAR(45)  DEFAULT NULL,
    updated_from_ip           VARCHAR(45)  DEFAULT NULL,
    created_at                DATETIME                    NOT NULL,
    updated_at                DATETIME                    NOT NULL,
    is_active                 TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX fk_idx_company_to_person_id (person_id),
    INDEX idx_company_physical_address_zip_code (physical_address_zip_code),
    INDEX idx_company_name_formal (name_formal),
    INDEX idx_company_billing_address_zip_code (billing_address_zip_code),
    INDEX idx_company_mailing_address_zip_code (mailing_address_zip_code),
    PRIMARY KEY (company_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE display_method
(
    display_method_id        INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for DisplayMethod',
    description_short        CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display the Long Description',
    sort_order               INT UNSIGNED DEFAULT 100000 COMMENT 'Order of Display',
    created_from_ip          VARCHAR(45)  DEFAULT NULL,
    updated_from_ip          VARCHAR(45)  DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    PRIMARY KEY (display_method_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE election
(
    election_id               INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for election',
    association_id            INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for association',
    heading                   CHAR(128)                   NOT NULL COMMENT 'line 1 text to describe the election',
    subheading                VARCHAR(512) DEFAULT NULL COMMENT 'line 2 text to describe the election',
    information               TEXT                        NOT NULL COMMENT 'html describing the election',
    date_start                DATETIME                    NOT NULL COMMENT 'Date and Time when Voting Starts',
    date_end                  DATETIME                    NOT NULL COMMENT 'Date and Time when Voting Ends',
    display_physical_address  TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Display the Physical Address on the form.',
    display_mailing_address   TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'display the Mailing Address on the form.',
    election_state            CHAR(2)      DEFAULT NULL COMMENT 'Physical Address State',
    votes_max                 INT UNSIGNED                NOT NULL COMMENT 'Total number of voters',
    votes_min                 INT UNSIGNED                NOT NULL COMMENT 'Minimum number of voters required to participate',
    voter_min_percent         INT UNSIGNED                NOT NULL COMMENT 'Minimum percentage of voters_total required to participate',
    allow_proxy_voting        TINYINT(1)   DEFAULT '1' COMMENT 'Allow for Proxy Votes',
    allow_in_person_voting    TINYINT(1)   DEFAULT '1' COMMENT 'Allow for In Person Voting',
    allow_write_in_candidates TINYINT(1)   DEFAULT '0' COMMENT 'Allow for Write In Candidates to be added',
    allow_proxy_directed      TINYINT(1)   DEFAULT '0' COMMENT 'Allow for Directed Proxies to be submitted.',
    allow_proxy_nondirected   TINYINT(1)   DEFAULT '0' COMMENT 'Allow for Non-Directed Proxies to be submitted.',
    allow_proxy_revocation    TINYINT(1)   DEFAULT '0' COMMENT 'Allow for Voter to Revoke a Proxy.',
    allow_mail_in_ballots     TINYINT(1)   DEFAULT '0' COMMENT 'Allow for Voter to Mail In a Ballot.',
    allow_public_results      TINYINT(1)   DEFAULT '0' COMMENT 'Allow for Results to be posted publicly on this Website.',
    url_election              CHAR(180)    DEFAULT NULL COMMENT 'url link to get to page describing the election',
    url_rules                 CHAR(180)    DEFAULT NULL COMMENT 'url link to get to page describing the election',
    physical_address_line1    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city     CHAR(128)    DEFAULT NULL COMMENT 'physical address city',
    physical_address_state    CHAR(2)      DEFAULT NULL COMMENT 'physical address state',
    physical_address_zip_code CHAR(16)     DEFAULT NULL COMMENT 'physical address zip code',
    mailing_address_line1     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city      CHAR(128)    DEFAULT NULL COMMENT 'mailing address city',
    mailing_address_state     CHAR(2)      DEFAULT NULL COMMENT 'mailing address state',
    mailing_address_zip_code  CHAR(16)     DEFAULT NULL COMMENT 'mailing address zip code',
    mailing_address_country   CHAR(2)      DEFAULT NULL COMMENT 'mailing address country code',
    created_from_ip           VARCHAR(45)  DEFAULT NULL,
    updated_from_ip           VARCHAR(45)  DEFAULT NULL,
    created_at                DATETIME                    NOT NULL,
    updated_at                DATETIME                    NOT NULL,
    is_active                 TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX fk_idx_election_to_association (association_id),
    INDEX idx_election_date_end (date_end),
    INDEX idx_election_date_start (date_start),
    PRIMARY KEY (election_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE election_date
(
    election_date_id         INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Election_Date',
    election_id              INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for election',
    date_value               DATETIME                    NOT NULL COMMENT 'Date of the Election Event',
    description_short        CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display the Long Description',
    created_from_ip          VARCHAR(45)  DEFAULT NULL,
    updated_from_ip          VARCHAR(45)  DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX idx_election_date_election_id (date_value),
    INDEX fk_idx_election_date_election_id (election_id),
    PRIMARY KEY (election_date_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE import
(
    import_id                 INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Imported Voters',
    upload_id                 INT UNSIGNED                NOT NULL COMMENT 'Primary Key for uploaded file',
    import_status_id          INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Import Status Voters',
    association_id            INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Company impersonating Association.',
    company_id                INT UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to Company not impersonating Association.',
    external_account_id       CHAR(128)    DEFAULT NULL COMMENT 'External Account ID from an Organization like a County Appraisal District.',
    internal_account_id       CHAR(128)    DEFAULT NULL COMMENT 'Internal Account ID from the Associations Accounting System.',
    internal_owner_id         CHAR(128)    DEFAULT NULL COMMENT 'Owner ID from the Assosciations Account System.  Useful when an owner owns more than one property.',
    internal_property_id      CHAR(128)    DEFAULT NULL COMMENT 'Property ID from the Assosciations Accounting System.',
    un                        CHAR(180)    DEFAULT NULL COMMENT 'UserName which can be used to log into the application.',
    pw                        CHAR(255)    DEFAULT NULL COMMENT 'Password which can be imported into the system.  This will be plain text and not encrypted.',
    ownership_start_date      CHAR(36)     DEFAULT NULL COMMENT 'Date and Time when this property was transacted. This should be in the YYYY-MM-DD HH:MM:SS format.',
    created_at                DATETIME                    NOT NULL COMMENT 'Date and Time this record was imported.',
    name_first                VARCHAR(32)  DEFAULT NULL COMMENT 'first name',
    name_middle               VARCHAR(32)  DEFAULT NULL COMMENT 'middle name',
    name_last                 VARCHAR(32)  DEFAULT NULL COMMENT 'last name',
    name_suffix               VARCHAR(12)  DEFAULT NULL COMMENT 'suffix',
    name_formal               VARCHAR(180) DEFAULT NULL COMMENT 'Formal/Formal Name',
    phone_home                CHAR(14)     DEFAULT NULL,
    phone_mobile              CHAR(14)     DEFAULT NULL,
    phone_work                CHAR(14)     DEFAULT NULL,
    phone_fax                 CHAR(14)     DEFAULT NULL,
    email                     VARCHAR(180) DEFAULT NULL,
    mailing_address_line1     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city      CHAR(128)    DEFAULT NULL COMMENT 'mailing address city',
    mailing_address_state     CHAR(2)      DEFAULT NULL COMMENT 'mailing address state',
    mailing_address_zip_code  CHAR(16)     DEFAULT NULL COMMENT 'mailing address zip code',
    mailing_address_country   CHAR(2)      DEFAULT NULL COMMENT 'mailing address country code',
    property_address_line1    CHAR(128)    DEFAULT NULL COMMENT 'Property Address line 1',
    property_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'Property Address line 1',
    property_address_city     CHAR(128)    DEFAULT NULL COMMENT 'Property Address city',
    property_address_state    CHAR(2)      DEFAULT NULL COMMENT 'Property Address state',
    property_address_zip_code CHAR(16)     DEFAULT NULL COMMENT 'Property Address zip code',
    county                    CHAR(255)    DEFAULT NULL COMMENT 'County Name',
    lot                       VARCHAR(512) DEFAULT NULL COMMENT 'Lot or Township part of a Legal Description.',
    block                     VARCHAR(512) DEFAULT NULL COMMENT 'Block or Range of a Legal Description.',
    subdivision               VARCHAR(512) DEFAULT NULL COMMENT 'Subdivision or Section of a Legal Description.',
    legal_description         TEXT         DEFAULT NULL COMMENT 'Full Legal Description including Metes and Bounds',
    INDEX IDX_9D4ECE1DCCCFBA31 (upload_id),
    INDEX idx_import_external_account_id (external_account_id),
    INDEX idx_import_internal_account_id (internal_account_id),
    INDEX idx_import_internal_owner_id (internal_owner_id),
    INDEX idx_import_internal_property_id (internal_property_id),
    INDEX idx_import_import_date_time (created_at),
    INDEX idx_import_association_id (association_id),
    INDEX idx_import_company_id (company_id),
    INDEX idx_import_import_status_id (import_status_id),
    PRIMARY KEY (import_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE import_status
(
    import_status_id  INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Import Status Voters',
    description_short CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    sort_order        INT UNSIGNED DEFAULT 100000 COMMENT 'Order of Display',
    is_active         TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    PRIMARY KEY (import_status_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE owner
(
    owner_id                     INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Owner',
    name_formal                  VARCHAR(180) DEFAULT NULL COMMENT 'Formal/Formal Name',
    name_first                   VARCHAR(32)  DEFAULT NULL COMMENT 'first name',
    name_middle                  VARCHAR(32)  DEFAULT NULL COMMENT 'middle name',
    name_last                    VARCHAR(32)  DEFAULT NULL COMMENT 'last name',
    name_suffix                  VARCHAR(12)  DEFAULT NULL COMMENT 'suffix',
    email                        VARCHAR(180) DEFAULT NULL,
    phone_work                   CHAR(14)     DEFAULT NULL,
    phone_home                   CHAR(14)     DEFAULT NULL,
    phone_mobile                 CHAR(14)     DEFAULT NULL,
    phone_fax                    CHAR(14)     DEFAULT NULL,
    un                           VARCHAR(180) DEFAULT NULL,
    pw                           CHAR(255)    DEFAULT NULL COMMENT 'Password for the UserInterface Login.  Note the SQL name is pw.',
    password_recovery_key        CHAR(32)     DEFAULT NULL COMMENT 'Key to be included in the verification email',
    password_recovery_date       DATETIME     DEFAULT NULL COMMENT 'Date password recovery was made.',
    password_recovery_ip_address CHAR(39)     DEFAULT NULL COMMENT 'IP Address where the password request was made.',
    roles                        JSON         DEFAULT NULL,
    physical_address_line1       CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_line2       CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city        CHAR(128)    DEFAULT NULL COMMENT 'physical address city',
    physical_address_state       CHAR(2)      DEFAULT NULL COMMENT 'physical address state',
    physical_address_zip_code    CHAR(16)     DEFAULT NULL COMMENT 'physical address zip code',
    mailing_address_line1        CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_line2        CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city         CHAR(128)    DEFAULT NULL COMMENT 'mailing address city',
    mailing_address_state        CHAR(2)      DEFAULT NULL COMMENT 'mailing address state',
    mailing_address_zip_code     CHAR(16)     DEFAULT NULL COMMENT 'mailing address zip code',
    mailing_address_country      CHAR(2)      DEFAULT NULL COMMENT 'mailing address country code',
    created_from_ip              VARCHAR(45)  DEFAULT NULL,
    updated_from_ip              VARCHAR(45)  DEFAULT NULL,
    created_at                   DATETIME                    NOT NULL,
    updated_at                   DATETIME                    NOT NULL,
    is_active                    TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    UNIQUE INDEX UNIQ_CF60E67CB99BD313 (un),
    INDEX idx_owner_phone_work (phone_work),
    INDEX idx_owner_un (un),
    INDEX idx_owner_email (email),
    INDEX idx_owner_phone_home (phone_home),
    INDEX idx_owner_phone_mobile (phone_mobile),
    PRIMARY KEY (owner_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE permission
(
    permission_id            INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Permission',
    role                     CHAR(255)   DEFAULT NULL COMMENT 'For Role Hierarchy in the Security.yml file.',
    roles                    JSON        DEFAULT NULL,
    can_create               TINYINT(1)  DEFAULT '0'     NOT NULL COMMENT 'Can User Create a Record',
    can_view                 TINYINT(1)  DEFAULT '0'     NOT NULL COMMENT 'Can User View a Record',
    can_update               TINYINT(1)  DEFAULT '0'     NOT NULL COMMENT 'Can User Update a Record',
    can_delete               TINYINT(1)  DEFAULT '0'     NOT NULL COMMENT 'Can User Delete a Record',
    category                 CHAR(255)   DEFAULT NULL COMMENT 'Category of the Permission Group',
    subcategory              CHAR(255)   DEFAULT NULL COMMENT 'SubCategory of the Permission Group',
    description_short        CHAR(255)   DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT        DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)  DEFAULT '0'     NOT NULL COMMENT 'Boolean - Display the Long Description',
    created_from_ip          VARCHAR(45) DEFAULT NULL,
    updated_from_ip          VARCHAR(45) DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)  DEFAULT '1'     NOT NULL COMMENT 'Is record active',
    INDEX idx_permission_description (description_short),
    PRIMARY KEY (permission_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE person
(
    id                           INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for person',
    person_type_id               INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key to Person_Type',
    verification_key             CHAR(32)     DEFAULT NULL COMMENT 'Key to be included in the verification email',
    verification_date            DATETIME     DEFAULT NULL COMMENT 'Date and time verification of email address was performed.',
    verification_ip_address      CHAR(39)     DEFAULT NULL COMMENT 'IP Address where the verification was made from.',
    has_started_registration     TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Has this person started registration',
    is_verified                  TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'is email address verified',
    is_registered                TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'is record registered',
    agreed_to_terms_at           DATETIME     DEFAULT NULL COMMENT 'ts when tos was agreed to',
    terms_id                     INT UNSIGNED DEFAULT NULL COMMENT 'Future Forein Key field to more complex legal framework.',
    roles                        JSON         DEFAULT NULL,
    name_formal                  VARCHAR(180) DEFAULT NULL COMMENT 'Formal/Formal Name',
    name_first                   VARCHAR(32)  DEFAULT NULL COMMENT 'first name',
    name_middle                  VARCHAR(32)  DEFAULT NULL COMMENT 'middle name',
    name_last                    VARCHAR(32)  DEFAULT NULL COMMENT 'last name',
    name_suffix                  VARCHAR(12)  DEFAULT NULL COMMENT 'suffix',
    mailing_address_line1        CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_line2        CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city         CHAR(128)    DEFAULT NULL COMMENT 'mailing address city',
    mailing_address_state        CHAR(2)      DEFAULT NULL COMMENT 'mailing address state',
    mailing_address_zip_code     CHAR(16)     DEFAULT NULL COMMENT 'mailing address zip code',
    mailing_address_country      CHAR(2)      DEFAULT NULL COMMENT 'mailing address country code',
    physical_address_line1       CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_line2       CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city        CHAR(128)    DEFAULT NULL COMMENT 'physical address city',
    physical_address_state       CHAR(2)      DEFAULT NULL COMMENT 'physical address state',
    physical_address_zip_code    CHAR(16)     DEFAULT NULL COMMENT 'physical address zip code',
    email                        VARCHAR(180) DEFAULT NULL,
    un                           VARCHAR(180) DEFAULT NULL,
    pw                           CHAR(255)    DEFAULT NULL COMMENT 'Password for the UserInterface Login.  Note the SQL name is pw.',
    password_recovery_key        CHAR(32)     DEFAULT NULL COMMENT 'Key to be included in the verification email',
    password_recovery_date       DATETIME     DEFAULT NULL COMMENT 'Date password recovery was made.',
    password_recovery_ip_address CHAR(39)     DEFAULT NULL COMMENT 'IP Address where the password request was made.',
    phone_home                   CHAR(14)     DEFAULT NULL,
    phone_work                   CHAR(14)     DEFAULT NULL,
    phone_mobile                 CHAR(14)     DEFAULT NULL,
    phone_fax                    CHAR(14)     DEFAULT NULL,
    created_from_ip              VARCHAR(45)  DEFAULT NULL,
    updated_from_ip              VARCHAR(45)  DEFAULT NULL,
    created_at                   DATETIME                    NOT NULL,
    updated_at                   DATETIME                    NOT NULL,
    is_active                    TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    UNIQUE INDEX UNIQ_34DCD176E7927C74 (email),
    UNIQUE INDEX UNIQ_34DCD176B99BD313 (un),
    INDEX fk_idx_person_to_person_type (person_type_id),
    INDEX idx_person_name_first (name_first),
    INDEX idx_person_verification_key (verification_key),
    INDEX idx_person_phone_work (phone_work),
    INDEX idx_person_name_last (name_last),
    INDEX idx_person_created_at (created_at),
    INDEX idx_person_phone_home (phone_home),
    INDEX idx_person_password_recovery_key (password_recovery_key),
    INDEX idx_person_phone_mobile (phone_mobile),
    INDEX idx_person_email (email),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE person_type
(
    person_type_id           INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key to Person_Type',
    description_short        CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display the Long Description',
    sort_order               INT UNSIGNED DEFAULT 100000 COMMENT 'Order of Display',
    created_from_ip          VARCHAR(45)  DEFAULT NULL,
    updated_from_ip          VARCHAR(45)  DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX idx_race_type_description_short (description_short),
    INDEX idx_race_type_sort_order (sort_order),
    PRIMARY KEY (person_type_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE property
(
    property_id               INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for property',
    association_id            INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for association',
    internal_property_id      CHAR(128)    DEFAULT NULL COMMENT 'Externally Produced Account ID from vendor or Appraisal District.',
    external_property_id      CHAR(128)    DEFAULT NULL COMMENT 'Internally Produced Account ID from Accounting System of the Association.',
    property_address_line1    CHAR(128)    DEFAULT NULL COMMENT 'Property Address line 1',
    property_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'Property Address line 1',
    property_address_city     CHAR(128)    DEFAULT NULL COMMENT 'Property Address city',
    property_address_state    CHAR(2)      DEFAULT NULL COMMENT 'Property Address state',
    property_address_zip_code CHAR(16)     DEFAULT NULL COMMENT 'Property Address zip code',
    county                    CHAR(255)    DEFAULT NULL COMMENT 'County Name',
    lot                       VARCHAR(512) DEFAULT NULL COMMENT 'Lot or Township part of a Legal Description.',
    block                     VARCHAR(512) DEFAULT NULL COMMENT 'Block or Range of a Legal Description.',
    subdivision               VARCHAR(512) DEFAULT NULL COMMENT 'Subdivision or Section of a Legal Description.',
    legal_description         TEXT         DEFAULT NULL COMMENT 'Full Legal Description including Metes and Bounds',
    created_from_ip           VARCHAR(45)  DEFAULT NULL,
    updated_from_ip           VARCHAR(45)  DEFAULT NULL,
    created_at                DATETIME                    NOT NULL,
    updated_at                DATETIME                    NOT NULL,
    is_active                 TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX fk_property_to_association (association_id),
    INDEX idx_property_internal_property_id (internal_property_id),
    INDEX idx_property_external_property_id (external_property_id),
    PRIMARY KEY (property_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE proxy_status
(
    proxy_status_id          INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Proxy Status',
    description_short        CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display the Long Description',
    sort_order               INT UNSIGNED DEFAULT 100000 COMMENT 'Order of Display',
    created_from_ip          VARCHAR(45)  DEFAULT NULL,
    updated_from_ip          VARCHAR(45)  DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    PRIMARY KEY (proxy_status_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE race
(
    race_id                  INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Race',
    election_id              INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for election',
    race_type_id             INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Race_Type',
    association_id           INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for association',
    heading                  CHAR(128)                   NOT NULL COMMENT 'line 1 text to describe the Race',
    subheading               CHAR(128)    DEFAULT NULL COMMENT 'line 2 text to describe the Race',
    select_min               INT UNSIGNED DEFAULT NULL COMMENT 'Minimum Number of Options Selected',
    select_max               INT UNSIGNED DEFAULT 1 COMMENT 'Maximum Number of Options Selected.',
    allow_for_quorum         TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Allow For Quorum Option.',
    allow_for_abstain        TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Allow for Abstain Option.',
    display_random           TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display Options in Random Order.',
    form_type                CHAR(32)     DEFAULT NULL COMMENT 'This is how the options will be displayed on the online form.',
    display_method           CHAR(32)     DEFAULT NULL COMMENT 'This will determine how the online form will be displayed.',
    display_incumbency       TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Boolean - Display Incumbent Status.',
    display_declared         TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Boolean - Display Declared Candidate.',
    display_write_in         TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Boolean - Display if is Write In Candidate.',
    sort_order               INT UNSIGNED DEFAULT 100000 COMMENT 'Order of Display',
    description_short        CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display the Long Description',
    created_from_ip          VARCHAR(45)  DEFAULT NULL,
    updated_from_ip          VARCHAR(45)  DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX idx_race_election_id (election_id),
    INDEX idx_race_race_type_id (race_type_id),
    INDEX idx_race_association_id (association_id),
    PRIMARY KEY (race_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE race_option
(
    race_option_id            INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Option or Candidate.',
    race_id                   INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Race',
    write_in_by_owner_id      INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Owner',
    is_person                 TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is this record a Person, not an Opion',
    is_write_in               TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Is this name a Write In',
    share_write_in            TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Does the voter want to share the name of the write in they have entered?',
    description_short         CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    name_formal               VARCHAR(180) DEFAULT NULL COMMENT 'Formal/Formal Name',
    name_first                VARCHAR(32)  DEFAULT NULL COMMENT 'first name',
    name_middle               VARCHAR(32)  DEFAULT NULL COMMENT 'middle name',
    name_last                 VARCHAR(32)  DEFAULT NULL COMMENT 'last name',
    name_suffix               VARCHAR(12)  DEFAULT NULL COMMENT 'suffix',
    email                     VARCHAR(180) DEFAULT NULL,
    phone_work                CHAR(14)     DEFAULT NULL,
    phone_home                CHAR(14)     DEFAULT NULL,
    phone_mobile              CHAR(14)     DEFAULT NULL,
    phone_fax                 CHAR(14)     DEFAULT NULL,
    physical_address_line1    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city     CHAR(128)    DEFAULT NULL COMMENT 'physical address city',
    physical_address_state    CHAR(2)      DEFAULT NULL COMMENT 'physical address state',
    physical_address_zip_code CHAR(16)     DEFAULT NULL COMMENT 'physical address zip code',
    display_physical_address  TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Display the Physical Address?',
    mailing_address_line1     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city      CHAR(128)    DEFAULT NULL COMMENT 'mailing address city',
    mailing_address_state     CHAR(2)      DEFAULT NULL COMMENT 'mailing address state',
    mailing_address_zip_code  CHAR(16)     DEFAULT NULL COMMENT 'mailing address zip code',
    mailing_address_country   CHAR(2)      DEFAULT NULL COMMENT 'mailing address country code',
    display_mailing_address   TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Display the Mailing Address?',
    created_from_ip           VARCHAR(45)  DEFAULT NULL,
    updated_from_ip           VARCHAR(45)  DEFAULT NULL,
    created_at                DATETIME                    NOT NULL,
    updated_at                DATETIME                    NOT NULL,
    is_active                 TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX idx_race_option_name_formal (name_formal),
    INDEX idx_race_option_name_first (name_first),
    INDEX idx_race_option_name_middle (name_middle),
    INDEX idx_race_option_name_last (name_last),
    INDEX idx_race_option_race_id (race_id),
    INDEX fk_idx_race_option_write_in_by_voter_id (write_in_by_owner_id),
    PRIMARY KEY (race_option_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE race_type
(
    race_type_id             INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Race_Type',
    description_short        CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display the Long Description',
    sort_order               INT UNSIGNED DEFAULT 100000 COMMENT 'Order of Display',
    created_from_ip          VARCHAR(45)  DEFAULT NULL,
    updated_from_ip          VARCHAR(45)  DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX idx_race_type_description_short (description_short),
    INDEX idx_race_type_sort_order (sort_order),
    PRIMARY KEY (race_type_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE relationship
(
    relationship_id      INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for relationships',
    person_id            INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for person',
    supervisor_id        INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for person',
    company_id           INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for company',
    association_id       INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for company',
    election_id          INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for election',
    owner_id             INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Owner',
    proxy_id             INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Owner',
    permission_id        INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Permission',
    relationship_type_id INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Relationship_Type',
    created_from_ip      VARCHAR(45)  DEFAULT NULL,
    updated_from_ip      VARCHAR(45)  DEFAULT NULL,
    created_at           DATETIME                    NOT NULL,
    updated_at           DATETIME                    NOT NULL,
    is_active            TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX IDX_200444A0DB26A4E (proxy_id),
    INDEX idx_relationship_association_id (association_id),
    INDEX idx_relationship_election_id (election_id),
    INDEX idx_relationship_owner_id (owner_id),
    INDEX idx_relationship_company_id (company_id),
    INDEX idx_relationship_permission_id (permission_id),
    INDEX idx_relationship_person_id (person_id),
    INDEX idx_relationship_supervisor_id (supervisor_id),
    INDEX idx_relationship_relationship_type_id (relationship_type_id),
    INDEX idx_relationship_person_and_association_id (person_id, association_id),
    INDEX idx_relationship_person_and_company_id (person_id, company_id),
    INDEX idx_relationship_person_and_permission_id (person_id, permission_id),
    INDEX idx_relationship_person_and_supervisor_id (person_id, supervisor_id),
    INDEX idx_relationship_person_and_relationship_type_id (person_id, relationship_type_id),
    PRIMARY KEY (relationship_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE relationship_type
(
    relationship_type_id     INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Relationship_Type',
    description_short        CHAR(255)    DEFAULT NULL COMMENT 'Short Description of the Element',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Element.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT '0'    NOT NULL COMMENT 'Boolean - Display the Long Description',
    sort_order               INT UNSIGNED DEFAULT 100000 COMMENT 'Order of Display',
    created_from_ip          VARCHAR(45)  DEFAULT NULL,
    updated_from_ip          VARCHAR(45)  DEFAULT NULL,
    created_at               DATETIME                    NOT NULL,
    updated_at               DATETIME                    NOT NULL,
    is_active                TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX idx_relationship_type_description_short (description_short),
    INDEX idx_relationship_type_sort_order (sort_order),
    PRIMARY KEY (relationship_type_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE sessions
(
    sess_id       VARCHAR(128) NOT NULL,
    sess_data     BLOB         NOT NULL,
    sess_time     INT UNSIGNED NOT NULL,
    sess_lifetime INT          NOT NULL,
    PRIMARY KEY (sess_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE upload
(
    upload_id                   INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for uploaded file',
    company_id                  INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for company',
    association_id              INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for company',
    original_uploaded_file_name CHAR(255)    DEFAULT NULL COMMENT 'Example: uploaded_test.xlsx',
    new_file_name               CHAR(255)    DEFAULT NULL COMMENT 'Example: uploaded-test-2019-09-12_07-18-28.xlsx',
    mime_type                   CHAR(255)    DEFAULT NULL COMMENT 'Example: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    guessed_file_extension      CHAR(255)    DEFAULT NULL COMMENT 'Example: xlsx',
    absolute_file_path          CHAR(255)    DEFAULT NULL COMMENT 'Example: /shared/httpd/community-election/public/uploads/12/uploaded-test-2019-09-12_07-18-28.xlsx',
    web_path                    CHAR(255)    DEFAULT NULL COMMENT 'Example: public/uploads/12/uploaded-test-2019-09-12_07-18-28.xlsx',
    created_from_ip             VARCHAR(45)  DEFAULT NULL,
    updated_from_ip             VARCHAR(45)  DEFAULT NULL,
    created_at                  DATETIME                    NOT NULL,
    updated_at                  DATETIME                    NOT NULL,
    is_active                   TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX IDX_17BDE61F979B1AD6 (company_id),
    INDEX IDX_17BDE61FEFB9C8A5 (association_id),
    PRIMARY KEY (upload_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE vote
(
    vote_id         INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for a cast vote.',
    ballot_id       INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for ballot.',
    race_option_id  INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key for Option or Candidate.',
    created_from_ip VARCHAR(45)  DEFAULT NULL,
    updated_from_ip VARCHAR(45)  DEFAULT NULL,
    created_at      DATETIME                    NOT NULL,
    updated_at      DATETIME                    NOT NULL,
    is_active       TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Is record active',
    INDEX idx_vote_race_option_id (race_option_id),
    INDEX idx_vote_ballot_id (ballot_id),
    PRIMARY KEY (vote_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE vote_audit_trail
(
    vote_audit_trail_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for a cast vote audit trails.',
    vote_id             INT UNSIGNED                NOT NULL COMMENT 'Primary Key for a cast vote.',
    ballot_id           INT UNSIGNED                NOT NULL COMMENT 'Primary Key for a cast vote.',
    race_option_id      INT UNSIGNED                NOT NULL COMMENT 'Primary Key for a cast vote.',
    created_from_ip     VARCHAR(45) DEFAULT NULL,
    updated_from_ip     VARCHAR(45) DEFAULT NULL,
    created_at          DATETIME                    NOT NULL,
    updated_at          DATETIME                    NOT NULL,
    INDEX idx_vote_audit_trail_ballot_id (ballot_id),
    INDEX idx_vote_audit_trail_race_option_id (race_option_id),
    PRIMARY KEY (vote_audit_trail_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE ext_translations
(
    id           INT AUTO_INCREMENT NOT NULL,
    locale       VARCHAR(8)         NOT NULL,
    object_class VARCHAR(255)       NOT NULL,
    field        VARCHAR(32)        NOT NULL,
    foreign_key  VARCHAR(64)        NOT NULL,
    content      LONGTEXT DEFAULT NULL,
    INDEX translations_lookup_idx (locale, object_class, foreign_key),
    UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB
  ROW_FORMAT = DYNAMIC;
CREATE TABLE ext_log_entries
(
    id           INT AUTO_INCREMENT NOT NULL,
    action       VARCHAR(8)         NOT NULL,
    logged_at    DATETIME           NOT NULL,
    object_id    VARCHAR(64)  DEFAULT NULL,
    object_class VARCHAR(255)       NOT NULL,
    version      INT                NOT NULL,
    data         LONGTEXT     DEFAULT NULL COMMENT '(DC2Type:array)',
    username     VARCHAR(255) DEFAULT NULL,
    INDEX log_class_lookup_idx (object_class),
    INDEX log_date_lookup_idx (logged_at),
    INDEX log_user_lookup_idx (username),
    INDEX log_version_lookup_idx (object_id, object_class, version),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB
  ROW_FORMAT = DYNAMIC;
ALTER TABLE association
    ADD CONSTRAINT FK_FD8521CC979B1AD6 FOREIGN KEY (company_id) REFERENCES company (company_id) ON DELETE SET NULL;
ALTER TABLE association_staff
    ADD CONSTRAINT FK_354661FFEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (association_id) ON DELETE SET NULL;
ALTER TABLE association_staff
    ADD CONSTRAINT FK_354661FF217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE SET NULL;
ALTER TABLE association_staff_permission
    ADD CONSTRAINT FK_C7B9B9A23B804FAB FOREIGN KEY (association_staff_id) REFERENCES association_staff (association_staff_id);
ALTER TABLE association_staff_permission
    ADD CONSTRAINT FK_C7B9B9A2FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (permission_id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BD6E59D40D FOREIGN KEY (race_id) REFERENCES race (race_id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BDA708DAFF FOREIGN KEY (election_id) REFERENCES election (election_id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BD7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (owner_id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BDDB26A4E FOREIGN KEY (proxy_id) REFERENCES owner (owner_id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BD4A221BC5 FOREIGN KEY (ballot_status_id) REFERENCES ballot_status (ballot_status_id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BD91C5F362 FOREIGN KEY (proxy_status_id) REFERENCES proxy_status (proxy_status_id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BD549213EC FOREIGN KEY (property_id) REFERENCES property (property_id);
ALTER TABLE election
    ADD CONSTRAINT FK_DCA03800EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (association_id);
ALTER TABLE election_date
    ADD CONSTRAINT FK_36D1405CA708DAFF FOREIGN KEY (election_id) REFERENCES election (election_id) ON DELETE SET NULL;
ALTER TABLE import
    ADD CONSTRAINT FK_9D4ECE1DCCCFBA31 FOREIGN KEY (upload_id) REFERENCES upload (upload_id);
ALTER TABLE import
    ADD CONSTRAINT FK_9D4ECE1D3636B401 FOREIGN KEY (import_status_id) REFERENCES import_status (import_status_id) ON DELETE SET NULL;
ALTER TABLE person
    ADD CONSTRAINT FK_34DCD176E7D23F1A FOREIGN KEY (person_type_id) REFERENCES person_type (person_type_id) ON DELETE SET NULL;
ALTER TABLE property
    ADD CONSTRAINT FK_8BF21CDEEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (association_id) ON DELETE SET NULL;
ALTER TABLE race
    ADD CONSTRAINT FK_DA6FBBAFA708DAFF FOREIGN KEY (election_id) REFERENCES election (election_id) ON DELETE SET NULL;
ALTER TABLE race
    ADD CONSTRAINT FK_DA6FBBAFDAFC59E3 FOREIGN KEY (race_type_id) REFERENCES race_type (race_type_id) ON DELETE SET NULL;
ALTER TABLE race
    ADD CONSTRAINT FK_DA6FBBAFEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (association_id) ON DELETE SET NULL;
ALTER TABLE race_option
    ADD CONSTRAINT FK_30D01E636E59D40D FOREIGN KEY (race_id) REFERENCES race (race_id) ON DELETE SET NULL;
ALTER TABLE race_option
    ADD CONSTRAINT FK_30D01E6390345DB8 FOREIGN KEY (write_in_by_owner_id) REFERENCES owner (owner_id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A0217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A019E9AC5F FOREIGN KEY (supervisor_id) REFERENCES person (id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A0979B1AD6 FOREIGN KEY (company_id) REFERENCES company (company_id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A0EFB9C8A5 FOREIGN KEY (association_id) REFERENCES company (company_id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A0A708DAFF FOREIGN KEY (election_id) REFERENCES election (election_id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A07E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (owner_id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A0DB26A4E FOREIGN KEY (proxy_id) REFERENCES owner (owner_id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A0FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (permission_id) ON DELETE SET NULL;
ALTER TABLE relationship
    ADD CONSTRAINT FK_200444A0F15DB61A FOREIGN KEY (relationship_type_id) REFERENCES relationship_type (relationship_type_id) ON DELETE SET NULL;
ALTER TABLE upload
    ADD CONSTRAINT FK_17BDE61F979B1AD6 FOREIGN KEY (company_id) REFERENCES company (company_id) ON DELETE SET NULL;
ALTER TABLE upload
    ADD CONSTRAINT FK_17BDE61FEFB9C8A5 FOREIGN KEY (association_id) REFERENCES company (company_id) ON DELETE SET NULL;
ALTER TABLE vote
    ADD CONSTRAINT FK_5A108564DDC23F6C FOREIGN KEY (ballot_id) REFERENCES ballot (ballot_id) ON DELETE SET NULL;
ALTER TABLE vote
    ADD CONSTRAINT FK_5A1085647E425D72 FOREIGN KEY (race_option_id) REFERENCES race_option (race_option_id) ON DELETE SET NULL;

-- /DDL -----------------------------------------------------------------------------
-- /DDL -----------------------------------------------------------------------------
-- /DDL -----------------------------------------------------------------------------
-- /DDL -----------------------------------------------------------------------------


SET FOREIGN_KEY_CHECKS = 0
;

CREATE TABLE `rememberme_token`
(
    `series`   CHAR(88) UNIQUE PRIMARY KEY NOT NULL,
    `value`    CHAR(88)                    NOT NULL,
    `lastUsed` DATETIME                    NOT NULL,
    `class`    VARCHAR(100)                NOT NULL,
    `username` VARCHAR(200)                NOT NULL
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB
  ROW_FORMAT = DYNAMIC
;

SET FOREIGN_KEY_CHECKS = 1
;


-- Data for Person Type
SET FOREIGN_KEY_CHECKS = 0
;

TRUNCATE TABLE person_type
;

INSERT INTO person_type
(person_type_id, description_short, description_long, updated_at, created_at, is_active)
VALUES (100, 'association_self_managed',
        'I am an Employee of a Self-Managed Homeowner\'s / Property Owner\'s Association.', now(),
        now(), 1),
       (200, 'association_management_company', 'I am an Employee of an Association Management Company.', now(), now(),
        1),
       (300, 'association_member_evaluating', 'I am a Homeowner in an Association Evaluating this Web Application.',
        now(), now(), 1),
       (400, 'association_board_member_evaluating',
        'I am a Board Member of an Association Evaluating this Web Application.', now(), now(), 1),
       (500, 'voting_member', 'A Voting Member of an Association', now(), now(), 1)
;

SET FOREIGN_KEY_CHECKS = 1
;


SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO import_status( import_status_id
                         , description_short
                         , sort_order
                         , is_active)
VALUES (1000, 'File Uploaded', 1000, 1),
       (2000, 'Data Reviewed', 2000, 1),
       (3000, 'Data Migrated', 3000, 1),
       (4000, 'To Be Deleted', 4000, 1);

SET FOREIGN_KEY_CHECKS = 1
;



SET FOREIGN_KEY_CHECKS = 0
;

TRUNCATE TABLE relationship_type
;


INSERT INTO relationship_type( relationship_type_id
                             , description_short
                             , description_long
                             , display_description_long
                             , sort_order
                             , created_from_ip
                             , updated_from_ip
                             , created_at
                             , updated_at
                             , is_active)
VALUES (100, 'User to Self', 'This is the internal relationship between a new user and their self.', 1, 100,
        '127.0.0.1', '127.0.0.1', NOW(), NOW(), 1),
       (200, 'Association to Company', 'This is the relationship between an Association and a Company', 1, 100,
        '127.0.0.1', '127.0.0.1', NOW(), NOW(), 1),
       (1000, 'User Permission',
        'This defines a relationship between a User, Association or Company and what permission they have been granted.',
        1, 100, '127.0.0.1', '127.0.0.1',
        NOW(), NOW(), 1),
       (3100, 'Owner to Association', 'Relationship between a Voter/Member of an Association and the Association.', 1,
        100, '127.0.0.1', '127.0.0.1', NOW(), NOW(), 1),
       (3200, 'Owner to Election', 'Relationship between a Voter/Member of an Association and an Election.', 1, 100,
        '127.0.0.1', '127.0.0.1', NOW(), NOW(), 1),
       (3300, 'Proxy to Owner',
        'Relationship between a Proxy and a Property Owner in an election.  This also requires an Election ID to be set. ',
        1, 100, '127.0.0.1',
        '127.0.0.1', NOW(), NOW(), 1),
       (4000, 'Election to Association', '', 1, 100, '127.0.0.1', '127.0.0.1', NOW(), NOW(), 1),
       (5000, 'User to Election', '', 1, 100, '127.0.0.1', '127.0.0.1', NOW(), NOW(), 1),
       (5100, 'User to Association',
        'A User to an Association Relationship.  This might be any official
		which might be conducting an election, like an Election Committee.   This
		is also allows for the assignment of Management Company Employees into
		an Association. ',
        0, 100, '127.0.0.1', '127.0.0.1', NOW(), NOW(), 1),
       (5200, 'User to Company',
        'A User to a Company Relationship.  This is an employee of a
		management company.  When the Company Type is an Association, then
		Employee-Users of the Management Company will be represented by this
		Relationship Type.',
        0, 100, '127.0.0.1', '127.0.0.1', NOW(), NOW(), 1)
;

SET FOREIGN_KEY_CHECKS = 1
;



SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO proxy_status
(proxy_status_id,
 description_short,
 description_long,
 display_description_long, sort_order, created_from_ip, updated_from_ip, created_at, updated_at, is_active)
VALUES (100,
        'Not Assigned',
        'There is not a Proxy Assigned to this Ballot.   This is the Owner or Member of the Association potentially Casting their vote.',
        0, 100, '127.0.0.1', '127.0.0.1', '2019-08-12 00:00:00', '2019-08-12 00:00:00', 1),

       (200,
        'Assigned - Proxy Assigned, Not Received, Not Logged In',
        'This Owner/Member has Assigned their Proxy to another Party but the Party has not Logged In yet.',
        0, 200, '127.0.0.1', '127.0.0.1', '2019-08-12 00:00:00', '2019-08-12 00:00:00', 1),

       (300,
        'Assigned - Proxy Assigned, Received, Account Created, Not yet voted',
        'The Proxy has Received the notice and has created their Account.  They not not yet voted.',
        0, 300, '127.0.0.1', '127.0.0.1', '2019-08-12 00:00:00', '2019-08-12 00:00:00', 1),

       (400,
        'Voted - Not Revoked, Ballot will be Counted',
        'The Proxy has voted and this Ballot will stand at the close of the Election.',
        0, 400, '127.0.0.1', '127.0.0.1', '2019-08-12 00:00:00', '2019-08-12 00:00:00', 1),

       (500,
        'Revoked Proxy - The Owner has Revoked the Assigned Proxy. The Owner has not Voted or Re-Assigned Proxy',
        'The Owner/Member has Revoked the Proxy which was assigned to the third Party.  The Owner/Member has not Voted or Re-Assigned the Proxy to another Party.',
        0, 500, '127.0.0.1', '127.0.0.1', '2019-08-12 00:00:00', '2019-08-12 00:00:00', 1),

       (600,
        'Revoked Proxy and Voted - The Owner has Revoked the Assigned Proxy and has Voted',
        'The Owner/Member has Revoked the Proxy which was assigned to the third Party.  The Owner/Member has Voted.',
        0, 600, '127.0.0.1', '127.0.0.1', '2019-08-12 00:00:00', '2019-08-12 00:00:00', 1),

       (700,
        'Revoked Proxy and Re-Assigned - The Owner has Revoked the Assigned Proxy and has Assigned it to Another Party',
        'The Owner/Member has Revoked the Proxy which was assigned to the third Party.  The Owner/Member has then Assigned the Proxy to Another Party.',
        0, 700, '127.0.0.1', '127.0.0.1', '2019-08-12 00:00:00', '2019-08-12 00:00:00', 1),

       (800,
        'Proxy is Locked - The Proxy is Locked for Administrative or Fraud Reasons',
        'The Proxy has been Locked by the Election Administrator for Fraud or Administrative Reasons.',
        0, 800, '127.0.0.1', '127.0.0.1', '2019-08-12 00:00:00', '2019-08-12 00:00:00', 1)
;

SET FOREIGN_KEY_CHECKS = 1
;



SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO permission(permission_id, description_short, description_long, display_description_long, created_from_ip,
                       updated_from_ip, created_at, updated_at, is_active, category,
                       subcategory)
VALUES (1, 'SuperUser', 'Owner of the Website, HMFIC', 1, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Site', 'Owner'),
       (100, 'Site Administrator', 'Administrator of the Website, NOT the HMFIC', 0, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Site',
        'Administrator'),
       (500, 'Customer Service Supervisor', 'Use in charge of CSR', 0, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Site', 'Supervisor'),
       (550, 'Customer Service Representative', 'Customer Service Representative', 0, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Site', 'CSR'),
       (1000, 'Company Owner', 'Originator of the Site Account and Super User over the Company', 1, '127.0.0.1',
        '127.0.0.1', '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1,
        'Company', NULL),
       (1010, 'Create Company User', 'User can Create a Company', 1, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Company', NULL),
       (1020, 'Edit Company User', 'User can Edit a Company', 1, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Company', NULL),
       (1030, 'Remove Company User', 'User can Remove a Company', 1, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Company', NULL),
       (2010, 'Create Association', 'User can Create an Association', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Association', NULL),
       (2020, 'Edit Association', 'User can Edit an Association', 1, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Association', NULL),
       (2030, 'Remove Association', 'User can Remove an Association', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Association', NULL),
       (3010, 'Create Association User', 'User can Create an Association User', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Association', NULL),
       (3020, 'Edit Association User', 'User can Edit an Association User', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Association', NULL),
       (3030, 'Remove Association User', 'User can Remove an Association User', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Association', NULL),
       (4010, 'Administer Election', 'User can Administer an Election', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Election', NULL),
       (4020, 'Audit Election', 'User can Audit an Election', 1, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Election', NULL),
       (4030, 'Supervise Election', 'User can Supervise an Election', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Election', NULL),
       (4150, 'Upload Property Data', 'User can Upload Property Data', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Election', NULL),
       (4160, 'Edit Property', 'User can Edit Property Data', 1, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Voter', NULL),
       (4170, 'Remove Property', 'User can Remove Property Data', 1, '127.0.0.1', '127.0.0.1', '2019-08-25 09:07:44',
        '2019-08-25 09:07:44', 1, 'Voter', NULL),
       (5010, 'Print Proxy and Ballot', 'User can Print Proxies and Ballots', 1, '127.0.0.1', '127.0.0.1',
        '2019-08-25 09:07:44', '2019-08-25 09:07:44', 1, 'Clerical', NULL)
;

SET FOREIGN_KEY_CHECKS = 1
;


--  Testing Users
--  Testing Users
--  Testing Users
--  Testing Users
--  Testing Users
--  Testing Users
SET FOREIGN_KEY_CHECKS = 0
;

TRUNCATE TABLE hoa.person
;

USE hoa
;

INSERT INTO `person`(`id`, `person_type_id`, `pw`, `password_recovery_key`, `password_recovery_date`,
                     `password_recovery_ip_address`, `roles`, `verification_key`,
                     `verification_date`, `verification_ip_address`, `has_started_registration`, `is_verified`,
                     `is_registered`, `agreed_to_terms_at`, `terms_id`, `name_formal`,
                     `name_first`, `name_middle`, `name_last`, `name_suffix`, `mailing_address_line1`,
                     `mailing_address_line2`, `mailing_address_city`, `mailing_address_state`,
                     `mailing_address_zip_code`, `mailing_address_country`, `physical_address_line1`,
                     `physical_address_line2`, `physical_address_city`, `physical_address_state`,
                     `physical_address_zip_code`, `email`, `un`, `phone_home`, `phone_work`, `phone_mobile`,
                     `phone_fax`, `created_from_ip`, `updated_from_ip`, `created_at`,
                     `updated_at`, `is_active`)
VALUES (1, NULL, '$argon2id$v=19$m=65536,t=4,p=1$VzhKaTBJWkFET1Iwb084dQ$+AKM9Hr+GZHEafa6Q9nxZBy/DLeLtCw2BUC2xDVsjKY',
        NULL, NULL, NULL, '[
    "ROLE_SUPER_ADMIN"
  ]', '68c17434c119932defa9d66db4c26577', '2019-09-02 13:45:53', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:53', 1,
        'Tom Olson - Admin', 'Tom', 'E', 'Olson', NULL,
        '1601 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1601 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'tom@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:53',
        '2019-09-02 13:45:53', 1),
       (2, NULL, '$argon2id$v=19$m=65536,t=4,p=1$UERuVFVoYTZ5eTNVdmNlWg$NhjdEN9nEj+H4Agzx9r6v7ozOr9Auh97m70rzWike/I',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', '55a25eda81090ae5289d978769fe6993', '2019-09-02 13:45:54', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:54', 1,
        'Christina Garza', 'Christina', 'L', 'Garza', NULL,
        '1602 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1602 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:54',
        '2019-09-02 13:45:54', 1),
       (3, NULL, '$argon2id$v=19$m=65536,t=4,p=1$QTB0R1lyY0RMaS91cThRUw$0Zk26G/GJ4VeNEhI3rGiwO6u41LXH9pfG4Tb8vYfzJU',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', '764dcff9d243d61d2238cbf5879d657c', '2019-09-02 13:45:55', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:55', 1,
        'Chris Olson', 'Chris', 'E', 'Olson', NULL,
        '1603 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1603 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce3@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:55',
        '2019-09-02 13:45:55', 1),
       (4, NULL, '$argon2id$v=19$m=65536,t=4,p=1$ei5sbXRqaDdST3RINWlVUQ$9hL8utlkYd+Bgy+5Hjyp491oGN27jXBgbDOplGTAmbU',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', '484953aac0f4d937df5e9f8df42b3969', '2019-09-02 13:45:55', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:55', 1,
        'Carolyn Olson', 'Carolyn', 'M', 'Olson', NULL,
        '1604 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1604 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce4@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:55',
        '2019-09-02 13:45:55', 1),
       (5, NULL, '$argon2id$v=19$m=65536,t=4,p=1$ZjFHclo4ckMzLlRGZUVFdw$wYzC5qHLQikPEl7pef3D826FV262ZUCTAnAEh4J52CE',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', '69e77f10ac927ad9bc1171e0d92a2497', '2019-09-02 13:45:56', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:56', 1,
        'Edwin Olson', 'Edwin', 'W', 'Olson', NULL,
        '1605 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1605 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce5@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:56',
        '2019-09-02 13:45:56', 1),
       (6, NULL, '$argon2id$v=19$m=65536,t=4,p=1$MjJBdUxIV2I3ekswZTY4Sw$VuBd2tKIEZi8PZY2lOM+1Xx73E+q80Jw94pggJ04alc',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', '7f74b9f453ce9236a4d8069c9a209b6d', '2019-09-02 13:45:56', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:56', 1,
        'Eileen Garza', 'Eileen', 'E', 'Garza', NULL,
        '1606 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1606 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce6@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:56',
        '2019-09-02 13:45:56', 1),
       (7, NULL, '$argon2id$v=19$m=65536,t=4,p=1$OTM2RkR0R1JQZnB4bmJORA$SM3c/j6AEsj+eWEtWsxuYMtT/O1llbkB+ZKj4n3cSBk',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', 'f37a1723a884792cfee6a9ec5f137c4f', '2019-09-02 13:45:57', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:57', 1,
        'Evelyn Garza', 'Evelyn', 'E', 'Garza', NULL,
        '1607 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1607 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce7@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:57',
        '2019-09-02 13:45:57', 1),
       (8, NULL, '$argon2id$v=19$m=65536,t=4,p=1$eVBSaHdVV1RxMi9nSmR6bA$PRmXiChlkMYW2JCA6YIyGu7b+5En/Pji7/2lQ7MlAXY',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', 'd57ce34fed26ccf5976339d9226f13f9', '2019-09-02 13:45:58', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:58', 1,
        'Ethan Garza', 'Ethan', 'E', 'Garza', NULL,
        '1608 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1608 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce8@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:58',
        '2019-09-02 13:45:58', 1),
       (9, NULL, '$argon2id$v=19$m=65536,t=4,p=1$T2Voa004dUxMQ01XZ09LWA$2YqMv3ECSd1fLkq+5iQI+d+6JjMt2/pUjv6pbbDlg1E',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', 'bfb2c1f6d9c82dcb9a3d6284aa468aa1', '2019-09-02 13:45:58', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:58', 1,
        'Emelia Garza', 'Emelia', 'E', 'Garza', NULL,
        '1609 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1609 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce9@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:58',
        '2019-09-02 13:45:58', 1),
       (10, NULL, '$argon2id$v=19$m=65536,t=4,p=1$MGNUcHBLRWxIUzY5RTg4Yw$OaoeNbKHhxf40VERDOu+XGnGJ8AP30FoqSID/hio4iQ',
        NULL, NULL, NULL, '[
         "ROLE_GROUP_COMPANY_OWNER"
       ]', 'cc5dc5681beb8f4b3c7b56852686528f', '2019-09-02 13:45:59', '127.0.0.1', 1, 1, 1, '2019-09-02 13:45:59', 1,
        'Eden Garza', 'Eden', 'E', 'Garza', NULL,
        '1610 Pennsylvania Avenue', NULL, 'Washington', 'DC', '22001', 'US', '1610 Pennsylvania Avenue', NULL,
        'Washington', 'DC', '22001', 'ce10@webtoaster.com', NULL,
        '281-236-2506', '281-256-2306', '281-236-2506', NULL, '127.0.0.1', '127.0.0.1', '2019-09-02 13:45:59',
        '2019-09-02 13:45:59', 1)
;

SET FOREIGN_KEY_CHECKS = 1
;



SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO company( person_id
                   , number_of_sections
                   , number_of_properties
                   , is_management_company
                   , is_association_company
                   , name_formal
                   , physical_address_line1
                   , physical_address_line2
                   , physical_address_city
                   , physical_address_state
                   , physical_address_zip_code
                   , display_physical_address
                   , mailing_address_line1
                   , mailing_address_line2
                   , mailing_address_city
                   , mailing_address_state
                   , mailing_address_zip_code
                   , mailing_address_country
                   , display_mailing_address
                   , billing_address_line1
                   , billing_address_line2
                   , billing_address_city
                   , billing_address_state
                   , billing_address_zip_code
                   , display_billing_address
                   , phone_work
                   , phone_fax
                   , url
                   , created_from_ip
                   , updated_from_ip
                   , created_at
                   , updated_at
                   , is_active)
VALUES ( 1
       , 0
       , 0
       , 1
       , 1
       , 'CommunityElection.com'
       , '1600 Pennsylvania Ave'
       , NULL
       , 'Washington'
       , 'DC'
       , '20001'
       , 1
       , '1600 Pennsylvania Ave'
       , NULL
       , 'Washington'
       , 'DC'
       , '20001'
       , NULL
       , 1
       , NULL
       , NULL
       , NULL
       , NULL
       , NULL
       , 0
       , '281-236-2506'
       , '281-236-2506'
       , 'http://www.community-election.com'
       , '127.0.0.1'
       , '127.0.0.1'
       , NOW()
       , NOW()
       , 1)
;

SET FOREIGN_KEY_CHECKS = 1
;



SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO relationship
(person_id, supervisor_id, company_id, association_id, permission_id, relationship_type_id, created_from_ip,
 updated_from_ip, created_at, updated_at, is_active)
VALUES (1, 1, 1, NULL, 1, 3100, '127.0.0.1', '127.0.0.1', now(), now(), 1)
;

SET FOREIGN_KEY_CHECKS = 1
;


SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO company( number_of_sections
                   , number_of_properties
                   , is_management_company
                   , is_association_company
                   , name_formal
                   , physical_address_line1
                   , physical_address_city
                   , physical_address_state
                   , physical_address_zip_code
                   , display_physical_address
                   , mailing_address_line1
                   , mailing_address_city
                   , mailing_address_state
                   , mailing_address_zip_code
                   , display_mailing_address
                   , phone_work
                   , phone_fax
                   , created_from_ip
                   , updated_from_ip
                   , created_at
                   , updated_at
                   , is_active)


SELECT DISTINCT FLOOR(RAND() * (20 - 5 + 1) + 1)    AS number_of_sections
              , FLOOR(RAND() * (2500 - 5 + 1) + 10) AS number_of_properties
              , '0'                                 AS is_management_company
              , '1'                                 AS is_association_company
              , Name                                AS name_formal
              , Address                             AS physical_address_line_1
              , City                                AS physical_address_city
              , State                               AS physical_address_state
              , `Zip Code`                          AS physical_address_zip_code
              , 1                                   AS display_physical_address
              , Address                             AS mailing_address_line_1
              , City                                AS mailing_address_city
              , State                               AS mailing_address_state
              , `Zip Code`                          AS mailing_address_zip_code
              , 1                                   AS display_mailing_address
              , NULL                                AS phone_work
              , NULL                                AS phone_fax
              , '127.0.0.1'                         AS created_from_ip
              , '127.0.0.1'                         AS updated_from_ip
              , NOW()                               AS created_at
              , NOW()                               AS updated_at
              , 1                                   AS is_active
FROM skeleton.exempts
WHERE (Name LIKE '%Condo%' AND
       Name LIKE '%owner%')
   OR (Name LIKE '%Condo%' AND
       Name LIKE '%assoc%')
   OR (Name LIKE '%Condo%' AND
       Name LIKE '%assoc%')
   OR Name LIKE '%CONDOMINIUM%'
   OR (Name LIKE '%prop%' AND
       Name LIKE '%owner%')
   OR (Name LIKE '%home%' AND
       Name LIKE '%owner%')
   OR (Name LIKE '%community%' AND
       Name LIKE '%impr%')
;

SET FOREIGN_KEY_CHECKS = 1
;

SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO person
(person_type_id, pw, password_recovery_key, password_recovery_date, password_recovery_ip_address, roles,
 verification_key, verification_date, verification_ip_address,
 has_started_registration, is_verified, is_registered, agreed_to_terms_at, terms_id, name_formal, name_first,
 name_middle, name_last, name_suffix, mailing_address_line1,
 mailing_address_line2, mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
 physical_address_line1, physical_address_line2,
 physical_address_city, physical_address_state, physical_address_zip_code, email, un, phone_home, phone_work,
 phone_mobile, phone_fax, created_from_ip, updated_from_ip, created_at,
 updated_at, is_active)


SELECT person_type_id,
       pw,
       password_recovery_key,
       password_recovery_date,
       password_recovery_ip_address,
       roles,
       verification_key,
       verification_date,
       verification_ip_address,
       has_started_registration,
       is_verified,
       is_registered,
       agreed_to_terms_at,
       terms_id,
       name_formal,
       name_first,
       name_middle,
       name_last,
       name_suffix,
       mailing_address_line1,
       mailing_address_line2,
       mailing_address_city,
       mailing_address_state,
       mailing_address_zip_code,
       mailing_address_country,
       physical_address_line1,
       physical_address_line2,
       physical_address_city,
       physical_address_state,
       physical_address_zip_code,
       email,
       un,
       phone_home,
       phone_work,
       phone_mobile,
       phone_fax,
       created_from_ip,
       updated_from_ip,
       created_at,
       updated_at,
       is_active
FROM skeleton.person
;

SET FOREIGN_KEY_CHECKS = 1
;

SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO association( company_id
                       , created_from_ip
                       , updated_from_ip
                       , created_at
                       , updated_at
                       , is_active)
SELECT company_id,
       '127.0.0.1',
       '127.0.0.1',
       NOW(),
       NOW(),
       1
FROM company
WHERE company.is_association_company = 1
;

SET FOREIGN_KEY_CHECKS = 1
;



SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO company( person_id
                   , number_of_sections
                   , number_of_properties
                   , is_management_company
                   , is_association_company
                   , name_formal
                   , physical_address_line1
                   , physical_address_line2
                   , physical_address_city
                   , physical_address_state
                   , physical_address_zip_code
                   , display_physical_address
                   , mailing_address_line1
                   , mailing_address_line2
                   , mailing_address_city
                   , mailing_address_state
                   , mailing_address_zip_code
                   , mailing_address_country
                   , display_mailing_address
                   , billing_address_line1
                   , billing_address_line2
                   , billing_address_city
                   , billing_address_state
                   , billing_address_zip_code
                   , display_billing_address
                   , phone_work
                   , phone_fax
                   , url
                   , created_from_ip
                   , updated_from_ip
                   , created_at
                   , updated_at
                   , is_active)
SELECT person_id
     , number_of_sections
     , number_of_properties
     , is_management_company
     , is_association_company
     , name_formal
     , physical_address_line1
     , physical_address_line2
     , physical_address_city
     , physical_address_state
     , physical_address_zip_code
     , display_physical_address
     , mailing_address_line1
     , mailing_address_line2
     , mailing_address_city
     , mailing_address_state
     , mailing_address_zip_code
     , mailing_address_country
     , display_mailing_address
     , billing_address_line1
     , billing_address_line2
     , billing_address_city
     , billing_address_state
     , billing_address_zip_code
     , display_billing_address
     , phone_work
     , phone_fax
     , url
     , created_from_ip
     , updated_from_ip
     , created_at
     , updated_at
     , is_active
FROM skeleton.company
;

SET FOREIGN_KEY_CHECKS = 1
;

SET FOREIGN_KEY_CHECKS = 0
;

UPDATE person
SET roles = '[
  "ROLE_USER"
]'
WHERE ROLES IS NULL
;

SET FOREIGN_KEY_CHECKS = 1
;


SET FOREIGN_KEY_CHECKS = 0
;

UPDATE person
SET roles = '[
  "ROLE_VOTER"
]'
WHERE person_type_id = 500
;

SET FOREIGN_KEY_CHECKS = 1
;



-- ----------------------------  Testing Relationships
-- ----------------------------  Testing Relationships
-- ----------------------------  Testing Relationships
-- ----------------------------  Testing Relationships
-- ----------------------------  Testing Relationships
-- ----------------------------  Testing Relationships


SET FOREIGN_KEY_CHECKS = 0
;


-- ----------------------------  Rename Some Companies
UPDATE company
SET name_formal            = 'HOA Management Company 1 Inc.',
    is_management_company  = 1,
    is_association_company = 0
WHERE company_id = 8301
;

UPDATE company
SET name_formal            = 'HOA Management Company 2 Inc.',
    is_management_company  = 1,
    is_association_company = 0
WHERE company_id = 8985
;

UPDATE company
SET name_formal            = 'HOA Management Company 3 Inc.',
    is_management_company  = 1,
    is_association_company = 0
WHERE company_id = 8296
;


-- ---------------Clean up the names of the Companies on the test data that got imported.
UPDATE company
SET name_formal = proper(name_formal)
;


--     -----------------------------------   Relates Company/Account Owners to Companies
INSERT INTO relationship
(person_id, supervisor_id, company_id, association_id, permission_id, relationship_type_id, created_from_ip,
 updated_from_ip, created_at, updated_at, is_active)
VALUES (2, 2, 8301, NULL, 1000, 5200, '127.0.0.1', '127.0.0.1', now(), now(), 1)
;

INSERT INTO relationship
(person_id, supervisor_id, company_id, association_id, permission_id, relationship_type_id, created_from_ip,
 updated_from_ip, created_at, updated_at, is_active)
VALUES (3, 3, 8985, NULL, 1000, 5200, '127.0.0.1', '127.0.0.1', now(), now(), 1)
;

INSERT INTO relationship
(person_id, supervisor_id, company_id, association_id, permission_id, relationship_type_id, created_from_ip,
 updated_from_ip, created_at, updated_at, is_active)
VALUES (4, 4, 8296, NULL, 1000, 5200, '127.0.0.1', '127.0.0.1', now(), now(), 1)
;

--     -----------------------------------   Relates Associations to Management Companies
INSERT INTO relationship
(person_id, supervisor_id, company_id, association_id, permission_id, relationship_type_id, created_from_ip,
 updated_from_ip, created_at, updated_at, is_active)
VALUES (NULL, NULL, 8301, 12, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 15, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 16, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 17, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 22, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 23, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 25, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 29, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 38, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 41, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 46, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 60, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 66, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 77, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 87, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 88, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 90, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 91, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 93, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 97, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 102, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 107, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 118, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 123, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 131, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 136, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8301, 145, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 465, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 476, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 479, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 481, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 482, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 483, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 486, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 487, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 488, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 495, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 497, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 498, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 499, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 502, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 503, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 504, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 505, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 506, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 507, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 508, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 509, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 511, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 514, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 515, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 516, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 518, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 519, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 521, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 523, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 524, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 525, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 526, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 528, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 529, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 530, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 531, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 532, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 535, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 536, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 538, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 539, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 540, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 542, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 544, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 547, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 548, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 549, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 552, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 553, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 555, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 556, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 557, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 558, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 559, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 561, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 563, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 564, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 567, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 571, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 572, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 573, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 577, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 579, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 583, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 586, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 587, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 589, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 590, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 591, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 593, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 596, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 597, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 598, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 600, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 602, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 607, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 611, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 612, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 613, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 614, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 616, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 618, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 621, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 633, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 636, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 638, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 642, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 644, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 646, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 647, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 650, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 651, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 654, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 655, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 656, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 658, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 659, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 660, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 661, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 662, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 665, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 667, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 670, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 674, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 677, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 678, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 679, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8985, 682, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1883, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1884, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1885, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1886, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1887, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1888, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1892, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1894, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1895, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1896, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1898, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1899, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1902, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1904, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1905, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1907, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1908, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1910, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1918, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1925, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1927, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1932, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1934, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1955, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1969, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1971, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1972, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1973, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1977, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1980, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1),
       (NULL, NULL, 8296, 1982, NULL, 200, '127.0.0.1', '127.0.0.1', now(), now(), 1)
;


SET FOREIGN_KEY_CHECKS = 1
;



SET FOREIGN_KEY_CHECKS = 0
;
truncate table import;

INSERT INTO `import`
(`import_id`, `upload_id`, `import_status_id`, `association_id`, `company_id`, `external_account_id`,
 `internal_account_id`, `internal_owner_id`, `internal_property_id`, `un`, `pw`, `ownership_start_date`, `created_at`,
 `name_first`, `name_middle`, `name_last`, `name_suffix`, `name_formal`, `phone_home`, `phone_mobile`, `phone_work`,
 `phone_fax`, `email`, `mailing_address_line1`, `mailing_address_line2`, `mailing_address_city`,
 `mailing_address_state`, `mailing_address_zip_code`, `mailing_address_country`, `property_address_line1`,
 `property_address_line2`, `property_address_city`, `property_address_state`, `property_address_zip_code`, `county`,
 `lot`, `block`, `subdivision`, `legal_description`)
VALUES (1, 1, 1000, 465, 8985, '00119-3026', 'SG000000119', 'SG000119H001', 'SG000119H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Alexander Koruth', '936-828-9073', '', '', '', '',
        '14838 Beaconsfield Dr', '', 'Dallas', 'Tx', '77043', null, '14838 Beaconsfield Dr', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '6', '13', 'Silver Green CIA', ''),
       (2, 1, 1000, 465, 8985, '00120-9949', 'SG000001439', 'SG001439H001', 'SG001439H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Esther Garcia', '936-208-2542', '', '', '', '', '1419 Stevenage Lane',
        '', 'Dallas', 'Tx', '77043', null, '1419 Stevenage Lane', '', 'Dallas', 'Tx', '77043', 'Dallas', '7', '4',
        'Silver Green CIA', ''),
       (3, 1, 1000, 465, 8985, '00230-7608', 'SG000002215', 'SG002215H001', 'SG002215H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Luis Vasquez', '910-527-2419', '', '', '', '', '14830 Scotter Dr', '',
        'Dallas', 'Tx', '77043', null, '14830 Scotter Dr', '', 'Dallas', 'Tx', '77043', 'Dallas', '2', '15',
        'Silver Green CIA', ''),
       (4, 1, 1000, 465, 8985, '00121-2952', 'SG000001659', 'SG001659H001', 'SG001659H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Wade Chen', '901-505-0729', '', '', '', '', '1418 Willersley Lane', '',
        'Dallas', 'Tx', '77043', null, '1418 Willersley Lane', '', 'Dallas', 'Tx', '77043', 'Dallas', '4', '5',
        'Silver Green CIA', ''),
       (5, 1, 1000, 465, 8985, '00119-3589', 'SG000000168', 'SG000168H001', 'SG000168H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Thomas Zacharian', '845-480-1326', '', '845-627-1851', '', '',
        '15330 Bedford Glen Dr', '', 'Dallas', 'Tx', '77043', null, '15330 Bedford Glen Dr', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '6', '6', 'Silver Green CIA', ''),
       (6, 1, 1000, 465, 8985, '00182-2449', 'SG000002020', 'SG002020H001', 'SG002020H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Erasmo Alas', '8362-231-3817', '', '214-452-0029', '', '',
        '14856 Peachmeadow Lane', '', 'Dallas', 'Tx', '77043', null, '14856 Peachmeadow Lane', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '4', '5', 'Silver Green CIA', ''),
       (7, 1, 1000, 465, 8985, '00187-4620', 'SG000002056', 'SG002056H001', 'SG002056H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Ezequiel Quiroz', '831-594-9905', '', '', '', '', '14815 Welbeck Drive',
        '', 'Dallas', 'Tx', '77043', null, '14815 Welbeck Drive', '', 'Dallas', 'Tx', '77043', 'Dallas', '9', '15',
        'Silver Green CIA', ''),
       (8, 1, 1000, 465, 8985, '00120-0168', 'SG000000699', 'SG000699H001', 'SG000699H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Alex and Josh Mathers', '821-812-1104', '', '', '', '',
        '14814 Keelby Dr', '', 'Dallas', 'Tx', '77043', null, '14814 Keelby Dr', '', 'Dallas', 'Tx', '77043', 'Dallas',
        '8', '10', 'Silver Green CIA', ''),
       (9, 1, 1000, 465, 8985, '00120-3644', 'SG000000975', 'SG000975H001', 'SG000975H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'James Thompson', '821-457-0003', '', '817-894-3343', '', '',
        '1418 Oakengates Dr', '', 'Dallas', 'Tx', '77043', null, '1418 Oakengates Dr', '', 'Dallas', 'Tx', '77043',
        'Dallas', '3', '11', 'Silver Green CIA', ''),
       (10, 1, 1000, 465, 8985, '00187-3919', 'SG000002054', 'SG002054H001', 'SG002054H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Teresa Guevera', '817-998-9616', '', '', '', '', '14840 Welbeck Drive',
        '', 'Dallas', 'Tx', '77043', null, '14840 Welbeck Drive', '', 'Dallas', 'Tx', '77043', 'Dallas', '15', '12',
        'Silver Green CIA', ''),
       (11, 1, 1000, 465, 8985, '00120-7187', 'SG000001233', 'SG001233H001', 'SG001233H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Rogelio Nieto', '817-984-8918', '', '', '', '',
        '14910 S Silver Green Dr', '', 'Dallas', 'Tx', '77043', null, '14910 S Silver Green Dr', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '2', '14', 'Silver Green CIA', ''),
       (12, 1, 1000, 465, 8985, '00119-8694', 'SG000000579', 'SG000579H001', 'SG000579H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Manuela Kinsale', '817-984-1224', '', '', '', '',
        '1354 Great Dover Cir', '', 'Dallas', 'Tx', '77043', null, '1354 Great Dover Cir', '', 'Dallas', 'Tx', '77043',
        'Dallas', '6', '8', 'Silver Green CIA', ''),
       (13, 1, 1000, 465, 8985, '00145-6323', 'SG000001784', 'SG001784H001', 'SG001784H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'David Diaz', '817-984-1122', '', '762-922-3070', '', '',
        '15123 Peachmeadow Lane', '', 'Dallas', 'Tx', '77043', null, '15123 Peachmeadow Lane', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '12', '3', 'Silver Green CIA', ''),
       (14, 1, 1000, 465, 8985, '00121-2279', 'SG000001602', 'SG001602H001', 'SG001602H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Erin Worley', '817-964-7996', '', '', '', '', '14850 Welbeck Drive', '',
        'Dallas', 'Tx', '77043', null, '14850 Welbeck Drive', '', 'Dallas', 'Tx', '77043', 'Dallas', '15', '10',
        'Silver Green CIA', ''),
       (15, 1, 1000, 465, 8985, '00121-3728', 'SG000001726', 'SG001726H001', 'SG001726H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Ruben L. Estrada', '817-947-8111', '', '', '', '', '1411 Wrotham Lane',
        '', 'Dallas', 'Tx', '77043', null, '1411 Wrotham Lane', '', 'Dallas', 'Tx', '77043', 'Dallas', '13', '6',
        'Silver Green CIA', ''),
       (16, 1, 1000, 465, 8985, '00148-4311', 'SG000001807', 'SG001807H001', 'SG001807H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Latoyna Gibson', '817-938-4357', '', '214-448-7550', '', '',
        '15046 Easingwold Dr', '', 'Dallas', 'Tx', '77043', null, '15046 Easingwold Dr', '', 'Dallas', 'Tx', '77043',
        'Dallas', '10', '1', 'Silver Green CIA', ''),
       (17, 1, 1000, 465, 8985, '00121-3320', 'SG000001690', 'SG001690H001', 'SG001690H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Jomar C. White', '817-928-3277', '', '817-928-4024', '', '',
        '1315 Wrotham Lane', '', 'Dallas', 'Tx', '77043', null, '1315 Wrotham Lane', '', 'Dallas', 'Tx', '77043',
        'Dallas', '3', '15', 'Silver Green CIA', ''),
       (18, 1, 1000, 465, 8985, '00153-9198', 'SG000001846', 'SG001846H001', 'SG001846H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Yasmin Davila', '817-918-8266', '', '', '', '', '1347 Stevenage Lane',
        '', 'Dallas', 'Tx', '77043', null, '1347 Stevenage Lane', '', 'Dallas', 'Tx', '77043', 'Dallas', '14', '14',
        'Silver Green CIA', ''),
       (19, 1, 1000, 465, 8985, '00202-1757', 'SG000002171', 'SG002171H001', 'SG002171H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Alfredo Centeno', '817-889-7291', '', '214-452-3230', '', '',
        '1310 Wrotham Lane', '', 'Dallas', 'Tx', '77043', null, '1310 Wrotham Lane', '', 'Dallas', 'Tx', '77043',
        'Dallas', '8', '6', 'Silver Green CIA', ''),
       (20, 1, 1000, 465, 8985, '00120-1251', 'SG000000785', 'SG000785H001', 'SG000785H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Edy Garcia', '817-884-7656', '', '', '', '', '1346 Littleport Lane', '',
        'Dallas', 'Tx', '77043', null, '1346 Littleport Lane', '', 'Dallas', 'Tx', '77043', 'Dallas', '3', '6',
        'Silver Green CIA', ''),
       (21, 1, 1000, 465, 8985, '00175-0139', 'SG000001978', 'SG001978H001', 'SG001978H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Marcos Fuentes Jr', '817-883-6765', '', '762-626-3027', '', '',
        '14839 Peachmeadow Lane', '', 'Dallas', 'Tx', '77043', null, '14839 Peachmeadow Lane', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '9', '11', 'Silver Green CIA', ''),
       (22, 1, 1000, 465, 8985, '00121-1526', 'SG000001565', 'SG001565H001', 'SG001565H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Antonio Ventura', '817-878-2479', '', '', '', '', '14923 Wainsfield Dr',
        '', 'Dallas', 'Tx', '77043', null, '14923 Wainsfield Dr', '', 'Dallas', 'Tx', '77043', 'Dallas', '13', '1',
        'Silver Green CIA', ''),
       (23, 1, 1000, 465, 8985, '00119-3534', 'SG000000163', 'SG000163H001', 'SG000163H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Arturo Torres', '817-877-2120', '', '409-998-1855', '', '',
        '15319 Bedford Glen Dr', '', 'Dallas', 'Tx', '77043', null, '15319 Bedford Glen Dr', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '9', '1', 'Silver Green CIA', ''),
       (24, 1, 1000, 465, 8985, '00120-4601', 'SG000001030', 'SG001030H001', 'SG001030H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Gerald Lawrence', '817-875-5296', '', '214-840-9932', '', '',
        '15018 Peachmeadow Lane', '', 'Dallas', 'Tx', '77043', null, '15018 Peachmeadow Lane', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '9', '2', 'Silver Green CIA', ''),
       (25, 1, 1000, 465, 8985, '00119-5448', 'SG000000318', 'SG000318H001', 'SG000318H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Charles Hudson', '817-869-7194', '', '', '', '', '1406 Crawley Ct', '',
        'Dallas', 'Tx', '77043', null, '1406 Crawley Ct', '', 'Dallas', 'Tx', '77043', 'Dallas', '15', '10',
        'Silver Green CIA', ''),
       (26, 1, 1000, 465, 8985, '00120-1840', 'SG000000829', 'SG000829H001', 'SG000829H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Tony Taft', '817-868-8506', '', '', '', '', '1302 Mac Clesby Lane', '',
        'Dallas', 'Tx', '77043', null, '1302 Mac Clesby Lane', '', 'Dallas', 'Tx', '77043', 'Dallas', '8', '11',
        'Silver Green CIA', ''),
       (27, 1, 1000, 465, 8985, '00120-2807', 'SG000000907', 'SG000907H001', 'SG000907H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Luis Duarte', '817-868-5995', '', '', '', '', '1714 Merton Dr', '',
        'Dallas', 'Tx', '77043', null, '1714 Merton Dr', '', 'Dallas', 'Tx', '77043', 'Dallas', '3', '4',
        'Silver Green CIA', ''),
       (28, 1, 1000, 465, 8985, '00120-5215', 'SG000001075', 'SG001075H001', 'SG001075H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Billie J Fitzpatrick', '817-868-4628', '', '', '', '',
        '15250 Peachmeadow Lane', '', 'Dallas', 'Tx', '77043', null, '15250 Peachmeadow Lane', '', 'Dallas', 'Tx',
        '77043', 'Dallas', '1', '11', 'Silver Green CIA', ''),
       (29, 1, 1000, 465, 8985, '00120-1950', 'SG000000836', 'SG000836H001', 'SG000836H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Sandra Escamilla', '817-868-2095', '', '', '', '',
        '1327 Mac Clesby Lane', '', 'Dallas', 'Tx', '77043', null, '1327 Mac Clesby Lane', '', 'Dallas', 'Tx', '77043',
        'Dallas', '4', '7', 'Silver Green CIA', ''),
       (30, 1, 1000, 465, 8985, '00173-2775', 'SG000001969', 'SG001969H001', 'SG001969H001', '', '', '2012-01-05',
        '2019-09-13 19:55:23', '', '', '', '', 'Abel Gonzalez', '817-867-4699', '', '', '', '', '1442 Littleport Lane',
        '', 'Dallas', 'Tx', '77043', null, '1442 Littleport Lane', '', 'Dallas', 'Tx', '77043', 'Dallas', '2', '5',
        'Silver Green CIA', '');

SET FOREIGN_KEY_CHECKS = 1
;

