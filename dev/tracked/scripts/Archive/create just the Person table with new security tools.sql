-- use information_schema;
DROP DATABASE IF EXISTS hoa
;

CREATE DATABASE hoa;
USE hoa;
SET FOREIGN_KEY_CHECKS = 0;
drop table if exists person
;

CREATE TABLE person
(
    id                           int(10) UNSIGNED                        NOT NULL AUTO_INCREMENT COMMENT 'primary key for person',
    -- Name Elements
    name_display                 varchar(108)                            NULL COMMENT 'display name',
    name_first                   varchar(32)                             NOT NULL COMMENT 'first name',
    name_middle                  varchar(32)                                      DEFAULT NULL COMMENT 'middle name',
    name_last                    varchar(32)                             NOT NULL COMMENT 'last name',
    name_suffix                  varchar(12)                                      DEFAULT NULL COMMENT 'suffix',
    -- phone elements
    phone_home                   char(12)                                         DEFAULT NULL,
    phone_mobile                 char(12)                                         DEFAULT NULL,
    phone_fax                    char(12)                                         DEFAULT NULL,
    phone_work                   char(12)                                         DEFAULT NULL,
    phone_work_extension         char(6)                                          DEFAULT NULL,
    -- Email elements
    email                        varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
    -- Mailing Address
    mailing_address_line1        char(128)                               NULL COMMENT 'mailing address line 1',
    mailing_address_line2        char(128)                               NULL COMMENT 'mailing address line 1',
    mailing_address_city         char(128)                               NULL COMMENT 'mailing address city',
    mailing_address_state        char(2)                                 NULL COMMENT 'mailing address state',
    mailing_address_zip_code     char(16)                                NULL COMMENT 'mailing address zip code',
    mailing_address_country      char(2)                                 NULL COMMENT 'mailing address country code',
    -- physical address
    physical_address_line1       char(128)                               NULL COMMENT 'physical address line 1',
    physical_address_line2       char(128)                               NULL COMMENT 'physical address line 1',
    physical_address_city        char(128)                               NULL COMMENT 'physical address city',
    physical_address_state       char(2)                                 NULL COMMENT 'physical address state',
    physical_address_zip_code    char(16)                                NULL COMMENT 'physical address zip code',
    -- Security elements
    ip_address                   char(39)                                NULL COMMENT 'ip address where the Person was submitted from.',
    roles                        JSON                                    NULL,
    -- Password Elements
    password                     varchar(255) COLLATE utf8mb4_unicode_ci NULL COMMENT 'This is NULL because non-user objects will also be stored within.',
    password_recovery_key        char(32)                                NULL COMMENT 'Key to be included in password recovery.',
    password_recovery_date       datetime                                NULL COMMENT 'Date password recovery was made.',
    password_recovery_ip_address char(39)                                NULL COMMENT 'IP Address where the password request was made.',
    -- Verification Elements
    verification_key             char(32)                                NULL COMMENT 'Key to be included in email verification.',
    verification_date            datetime                                NULL COMMENT 'Date email verification was made.',
    verification_ip_address      char(39)                                NULL COMMENT 'IP Address where the verification was made from.',
    -- updated and created
    updated_at                   datetime                                         DEFAULT NULL COMMENT 'ts when updated',
    created_at                   datetime                                         DEFAULT NULL COMMENT 'ts when inserted',
    -- switches
    has_started_registration     tinyint(1)                              NOT NULL DEFAULT 0 COMMENT 'Has this person started registration?',
    is_active                    tinyint(1)                              NOT NULL DEFAULT 0 COMMENT 'is record active',
    is_verified                  tinyint(1)                              NOT NULL DEFAULT 0 COMMENT 'is email address verified',
    is_registered                tinyint(1)                              NOT NULL DEFAULT 0 COMMENT 'is record registered',
    --  Legal
    agreed_to_terms_at           datetime                                         DEFAULT NULL COMMENT 'ts when user agreed to terms',
    terms_id                     int UNSIGNED                            NULL COMMENT 'Future Forein Key field to more complex legal framework.',
    -- Keys
    PRIMARY KEY (id),
    KEY idx_person_name_last (name_last) USING BTREE,
    KEY idx_person_name_first (name_first) USING BTREE,
    KEY idx_person_phone_mobile (phone_mobile) USING BTREE,
    key idx_person_phone_home (phone_home) USING BTREE,
    key idx_person_phone_work (phone_work) USING BTREE,
    KEY idx_person_email (email) USING BTREE,
    key idx_person_password_recovery_key (password_recovery_key) USING BTREE,
    key idx_person_created_at (created_at) USING BTREE,
    key idx_person_verification_key (verification_key) USING BTREE
    -- key idx_person_ () USING BTREE ,
    -- key idx_person_ () USING BTREE ,
    -- key idx_person_ () USING BTREE ,
    -- key idx_person_ () USING BTREE ,
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 4
    DEFAULT CHARSET = utf8mb4
    CHECKSUM = 1
    ROW_FORMAT = DYNAMIC COMMENT = 'defines a person'
;

CREATE TABLE sessions
(
    sess_id       VARCHAR(128)     NOT NULL PRIMARY KEY,
    sess_data     BLOB             NOT NULL,
    sess_time     INTEGER UNSIGNED NOT NULL,
    sess_lifetime MEDIUMINT        NOT NULL
)
    COLLATE utf8_bin,
    ENGINE = InnoDB
;

SET FOREIGN_KEY_CHECKS = 1;
GRANT ALL PRIVILEGES ON hoa.* To 'hoa_user'@'%' IDENTIFIED BY 'ThisPasswordIsStrong';
