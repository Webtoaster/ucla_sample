-- use information_schema;



-- CREATE DATABASE election_api;
USE hoa;
SET FOREIGN_KEY_CHECKS = 0;









drop table if EXISTS election ;


CREATE TABLE election
(
    election_id               INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for election',
    association_id            INT UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to Association',

    heading                   CHAR(128)                   NOT NULL COMMENT 'line 1 text to describe the election',
    subheading                CHAR(128)    DEFAULT NULL COMMENT 'line 2 text to describe the election',
    information               TEXT                        NOT NULL COMMENT 'html describing the election',

    date_start                DATETIME                    NOT NULL COMMENT 'Date and Time when Voting Starts',
    date_end                  DATETIME                    NOT NULL COMMENT 'Date and Time when Voting Ends',

    physical_address_line1    CHAR(128)                   NOT NULL COMMENT 'Physical Address Line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'Physical Address Line 2',
    physical_address_city     CHAR(128)                   NOT NULL COMMENT 'Physical Address City',
    physical_address_state    CHAR(2)                     NOT NULL COMMENT 'Physical Address State',
    physical_address_zip_code CHAR(16)                    NOT NULL COMMENT 'Physical Address Zip Code',
    display_physical_address  TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Display the Physical Address on the form.',

    mailing_address_line1     CHAR(128)                   NOT NULL COMMENT 'Mailing Address Line 1',
    mailing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'Mailing Address Line 2',
    mailing_address_city      CHAR(128)                   NOT NULL COMMENT 'Mailing Address City',
    mailing_address_state     CHAR(2)                     NOT NULL COMMENT 'Mailing Address State',
    mailing_address_zip_code  CHAR(16)                    NOT NULL COMMENT 'Mailing Address Zip Code',
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

    INDEX fk_idx_election_to_association (association_id),
    INDEX idx_election_date_start (date_start),
    INDEX idx_election_date_end (date_end),
    PRIMARY KEY (election_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;


drop table if EXISTS election_date;

CREATE TABLE election_date
(
    election_date_id         INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Election_Date',
    election_id              INT UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to Election',

    date_value               DATETIME                    NOT NULL COMMENT 'Date of the Election Event',

    description_short        VARCHAR(256)                NOT NULL COMMENT 'Short Description of the Date',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Date.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT 0      NOT NULL COMMENT 'Boolean - Display the Long Description',

    INDEX idx_election_date_election_id (date_value),
    INDEX fk_idx_election_date_election_id (election_id),
    PRIMARY KEY (election_date_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;


drop table if EXISTS  race_type  ;


CREATE TABLE race_type
(
    race_type_id             INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Race_Type',

    description_short        VARCHAR(256)                NOT NULL COMMENT 'Short Description of the Election Type',
    description_long         TEXT       DEFAULT NULL COMMENT 'Long Description of the Election Type.  Can be HTML',
    display_description_long TINYINT(1) DEFAULT 0        NOT NULL COMMENT 'Boolean - Display the Long Description',

    PRIMARY KEY (race_type_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;


drop table if EXISTS  race   ;


CREATE TABLE race
(
    race_id                  INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Race',
    race_type_id              INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Race Type',
    election_id              INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Election',

    sort_order               INT UNSIGNED DEFAULT '100000' COMMENT 'Sort Order for display on the Ballot.',

    heading                  CHAR(128)                   NOT NULL COMMENT 'line 1 text to describe the Race',
    subheading               CHAR(128)    DEFAULT NULL COMMENT 'line 2 text to describe the Race',
    description_short        VARCHAR(256)                NOT NULL COMMENT 'Short Description of the Race',
    description_long         TEXT         DEFAULT NULL COMMENT 'Long Description of the Race.  Can be HTML',
    display_description_long TINYINT(1)   DEFAULT 0      NOT NULL COMMENT 'Boolean - Display the Long Description',

    select_min               INT UNSIGNED DEFAULT '0' COMMENT 'Minimum Number of Options Selected',
    select_max               INT UNSIGNED DEFAULT '1' COMMENT 'Maximum Number of Options Selected.',

    allow_for_quorum         TINYINT(1)   DEFAULT 0      NOT NULL COMMENT 'Boolean - Allow For Quorum Option.',
    allow_for_abstain        TINYINT(1)   DEFAULT 0      NOT NULL COMMENT 'Boolean - Allow for Abstain Option.',


    form_type              CHAR(32)    COMMENT 'This is how the options will be displayed on the online form.',
    display_method         CHAR(32)    COMMENT 'This will determine how the online form will be displayed.',





    display_incumbency       TINYINT(1)   DEFAULT 1      NOT NULL COMMENT 'Boolean - Display Incumbent Status.',
    display_declared         TINYINT(1)   DEFAULT 1      NOT NULL COMMENT 'Boolean - Display Declared Candidate.',
    display_write_in         TINYINT(1)   DEFAULT 1      NOT NULL COMMENT 'Boolean - Display if is Write In Candidate.',

    PRIMARY KEY (race_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;


drop table if EXISTS  race_option   ;


CREATE TABLE race_option
(
    race_option_id            INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Option or Candidate.',
    race_id                   INT UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to Race',
    write_in_by_voter_id      INT UNSIGNED DEFAULT NULL COMMENT 'Foreign Key to voter',

    display                   CHAR(108)    DEFAULT NULL COMMENT 'Display Value',

    name_first                CHAR(32)     DEFAULT NULL COMMENT 'First Name',
    name_middle               CHAR(32)     DEFAULT NULL COMMENT 'Middle Name',
    name_last                 CHAR(32)     DEFAULT NULL COMMENT 'Last Name',
    name_suffix               CHAR(12)     DEFAULT NULL COMMENT 'suffix',

    email                     CHAR(180)                   NOT NULL,
    phone_mobile              CHAR(14)     DEFAULT NULL,
    phone_home                CHAR(14)     DEFAULT NULL,

    physical_address_line1    CHAR(128)    DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_city     CHAR(128)    DEFAULT NULL COMMENT 'Physical Address City',
    physical_address_state    CHAR(2)      DEFAULT NULL COMMENT 'Physical Address State',
    physical_address_zip_code CHAR(16)     DEFAULT NULL COMMENT 'Physical Address Zip Code',

    display_candidate_address TINYINT(1)   DEFAULT '0' COMMENT 'Display the candidates address?',

    is_write_in               TINYINT(1)                  NOT NULL COMMENT 'Is this name a Write In',
    share_write_in            TINYINT(1)                  NOT NULL COMMENT 'Does the voter want to share the name of the write in they have entered?',

    INDEX fk_idx_race_option_race_id (race_id),
    INDEX fk_idx_race_option_write_in_by_voter_id (write_in_by_voter_id),

    INDEX idx_race_option_race_id (race_id),
    INDEX idx_race_option_display (display),
    INDEX idx_race_option_name_first (name_first),
    INDEX idx_race_option_name_last (name_last),
    INDEX idx_race_option_name_middle (name_middle),


    PRIMARY KEY (race_option_id)

) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;


drop table if EXISTS  voter  ;


CREATE TABLE voter
(
    voter_id                  INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key for Voter',

    race_id                   INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Race',
    association_id            INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Association',
    property_id               INT UNSIGNED                NOT NULL COMMENT 'Foreign Key to Property',
    proxy_id                  INT UNSIGNED                NOT NULL COMMENT 'Self Referencing Key to Voter',

    name                      VARCHAR(180) NOT NULL COMMENT 'Legal Name for the Voter or Person Voting by Proxy (ie, Trustee Name).',

    email                     VARCHAR(180) DEFAULT NULL,
    phone_home                CHAR(14)     DEFAULT NULL,
    phone_work                CHAR(14)     DEFAULT NULL,
    phone_mobile              CHAR(14)     DEFAULT NULL,

    user_name                 CHAR(32)     DEFAULT NULL,
    password                  CHAR(255)    DEFAULT NULL,
    qr_code                   CHAR(255)    DEFAULT NULL,

    physical_address_line1    CHAR(128)    DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'Physical Address Line 1',
    physical_address_city     CHAR(128)    DEFAULT NULL COMMENT 'Physical Address City',
    physical_address_state    CHAR(2)      DEFAULT NULL COMMENT 'Physical Address State',
    physical_address_zip_code CHAR(16)     DEFAULT NULL COMMENT 'Physical Address Zip Code',

    mailing_address_line1     CHAR(128)    DEFAULT NULL COMMENT 'Mailing Address Line 1',
    mailing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'Mailing Address Line 1',
    mailing_address_city      CHAR(128)    DEFAULT NULL COMMENT 'Mailing Address City',
    mailing_address_state     CHAR(2)      DEFAULT NULL COMMENT 'Mailing Address State',
    mailing_address_zip_code  CHAR(16)     DEFAULT NULL COMMENT 'Mailing Address Zip Code',

    UNIQUE INDEX uniq_idx_voter_association_id_email (association_id, email),
    UNIQUE INDEX uniq_idx_voter_association_id_user_name (association_id, user_name),
    UNIQUE INDEX uniq_idx_voter_qr_code (qr_code),

    INDEX fk_idx_voter_to_race_id (race_id),
    INDEX fk_idx_voter_to_association_id (association_id),
    INDEX fk_idx_voter_to_property_id (property_id),
    INDEX fk_idx_voter_to_voter_on_proxy_id (proxy_id),

    INDEX idx_voter_phone_home (phone_home),
    INDEX idx_voter_phone_work (phone_work),
    INDEX idx_voter_phone_mobile (phone_mobile),

    PRIMARY KEY (voter_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;







SET FOREIGN_KEY_CHECKS = 1;





