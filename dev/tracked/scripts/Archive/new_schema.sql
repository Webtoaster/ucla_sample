
CREATE TABLE property
(
    property_id               INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for property',
    association_id            INT UNSIGNED DEFAULT NULL COMMENT 'primary key for association',
    owner_id                  INT UNSIGNED DEFAULT NULL COMMENT 'primary key for person',
    ext_hoa_property_id       CHAR(128)    DEFAULT NULL COMMENT 'externally produced foreign key for association tracking',
    ext_cad_property_id       CHAR(128)    DEFAULT NULL COMMENT 'externally produced foreign key for county appraisal district',
    date_start                DATETIME                    NOT NULL COMMENT 'date when this owner took posession.',
    date_end                  DATETIME     DEFAULT NULL COMMENT 'date when this owner lost posession.',
    physical_address_line1    CHAR(128)                   NOT NULL COMMENT 'physical address line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city     CHAR(128)                   NOT NULL COMMENT 'physical address city',
    physical_address_state    CHAR(2)      DEFAULT 'TX' NOT NULL COMMENT 'physical address state',
    physical_address_zip_code CHAR(16)                    NOT NULL COMMENT 'physical address zip code',
    legal_lot                 CHAR(32)     DEFAULT NULL COMMENT 'lot number(s) from legal description',
    legal_section             CHAR(32)     DEFAULT NULL COMMENT 'section number(s) from legal description',
    legal_block               CHAR(32)     DEFAULT NULL COMMENT 'block number(s) from legal description',
    legal_description         VARCHAR(256) DEFAULT NULL COMMENT 'full legal description',
    is_active                 TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'is record active',
    deletedAt                 DATETIME     DEFAULT NULL,
    created_from_ip           VARCHAR(45)  DEFAULT NULL,
    updated_from_ip           VARCHAR(45)  DEFAULT NULL,
    created_at                DATETIME                    NOT NULL,
    updated_at                DATETIME                    NOT NULL,
    INDEX fk_property_to_association (association_id),
    INDEX fk_idx_property_to_owner (owner_id),
    INDEX idx_property_ext_cad_property_id (ext_cad_property_id),
    INDEX idx_property_ext_hoa_property_id (ext_hoa_property_id),
    PRIMARY KEY (property_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;


CREATE TABLE voter
(
    voter_id             INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for voter',
    election_id          INT UNSIGNED  DEFAULT NULL COMMENT 'primary key for election',
    property_id          INT UNSIGNED  DEFAULT NULL COMMENT 'primary key for property',
    proxy_person_id      INT UNSIGNED  DEFAULT NULL COMMENT 'primary key for person',
    is_proxy             TINYINT(1)                  NOT NULL COMMENT 'is this voter a proxy for another homeowner?',
    updated_by_person_id INT UNSIGNED  DEFAULT NULL COMMENT 'soft foreign key to person.  person who updated the data.  on insert, it is the same as created.',
    created_by_person_id INT UNSIGNED  DEFAULT NULL COMMENT 'soft foreign key to person.  person who imported the data.',
    memorandum           VARCHAR(1024) DEFAULT NULL COMMENT 'memorandum of details related to this voter.  ie, moved before end of election',
    is_active            TINYINT(1)    DEFAULT '1'   NOT NULL COMMENT 'is record active',
    deletedAt            DATETIME      DEFAULT NULL,
    created_from_ip      VARCHAR(45)   DEFAULT NULL,
    updated_from_ip      VARCHAR(45)   DEFAULT NULL,
    created_at           DATETIME                    NOT NULL,
    updated_at           DATETIME                    NOT NULL,
    INDEX fk_voter_to_proxy_person_id (proxy_person_id),
    INDEX fk_idx_voter_election_id (election_id),
    INDEX fk_idx_voter_property_id (property_id),
    UNIQUE INDEX un_idx_voter_combined (property_id, election_id),
    PRIMARY KEY (voter_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;




CREATE TABLE association
(
    association_id        INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for association',
    company_id            INT UNSIGNED DEFAULT NULL COMMENT 'primary key for company',
    management_company_id INT UNSIGNED DEFAULT NULL COMMENT 'primary key for company',
    number_of_properties  INT UNSIGNED DEFAULT 1      NOT NULL COMMENT 'number of properties in this assocaition',
    number_of_sections    INT UNSIGNED DEFAULT 1      NOT NULL COMMENT 'number of sub-sections of the associations.',
    is_active             TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'is record active',
    deletedAt             DATETIME     DEFAULT NULL,
    created_from_ip       VARCHAR(45)  DEFAULT NULL,
    updated_from_ip       VARCHAR(45)  DEFAULT NULL,
    created_at            DATETIME                    NOT NULL,
    updated_at            DATETIME                    NOT NULL,
    INDEX fk_idx_association_to_company (company_id),
    INDEX fk_idx_relationship1 (management_company_id),
    PRIMARY KEY (association_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;



CREATE TABLE association_staff
(
    association_staff_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for table',
    association_id       INT UNSIGNED DEFAULT NULL COMMENT 'primary key for association',
    person_id            INT UNSIGNED DEFAULT NULL COMMENT 'primary key for person',
    is_attorney          TINYINT(1)                  NOT NULL COMMENT 'flag if staff member is attorney',
    job_title            CHAR(128)    DEFAULT NULL COMMENT 'descripton of off job',
    is_board_member      TINYINT(1)                  NOT NULL,
    date_start           DATETIME     DEFAULT NULL,
    date_end             DATETIME     DEFAULT NULL,
    is_active            TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'flag if record is active',
    deletedAt            DATETIME     DEFAULT NULL,
    created_from_ip      VARCHAR(45)  DEFAULT NULL,
    updated_from_ip      VARCHAR(45)  DEFAULT NULL,
    created_at           DATETIME                    NOT NULL,
    updated_at           DATETIME                    NOT NULL,
    INDEX fk_idx_association_staff_member_to_person (person_id),
    INDEX fk_idx_association_staff_member_to_association (association_id),
    UNIQUE INDEX un_idx_hoa_staff_member_combined (association_id, person_id),
    PRIMARY KEY (association_staff_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;
CREATE TABLE ballot
(
    ballot_id         INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for ballot.',
    ballot_type_id    INT UNSIGNED DEFAULT NULL COMMENT 'primary key for ballot_type',
    voter_id          INT UNSIGNED DEFAULT NULL COMMENT 'primary key for voter',
    ballot_key        CHAR(64)     DEFAULT NULL COMMENT 'key for handing a ballot to a proxy.',
    ip_address        CHAR(15)     DEFAULT NULL COMMENT 'ip address that e-ballot was cast from.',
    url_online_ballot CHAR(128)    DEFAULT NULL COMMENT 'url link to get to online ballot',
    url_paper_ballot  CHAR(128)    DEFAULT NULL COMMENT 'url link to get to pdf ballot ',
    uri_paper_trace   CHAR(128)    DEFAULT NULL COMMENT 'url link to get to the hard copy of the ballot',
    date_cast         DATETIME     DEFAULT NULL COMMENT 'date when ballot is cast.',
    prior_ballot_id   INT UNSIGNED DEFAULT NULL COMMENT 'if this ballot is re-cast, meaning it was changed, then this is self referencing. ',
    is_active         TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'is record active',
    deletedAt         DATETIME     DEFAULT NULL,
    created_from_ip   VARCHAR(45)  DEFAULT NULL,
    updated_from_ip   VARCHAR(45)  DEFAULT NULL,
    created_at        DATETIME                    NOT NULL,
    updated_at        DATETIME                    NOT NULL,
    INDEX fk_idx_ballot_ballot_type_id (ballot_type_id),
    UNIQUE INDEX un_idx_ballot_ballot_id (voter_id),
    PRIMARY KEY (ballot_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;


CREATE TABLE vote
(
    ballot_id    INT UNSIGNED NOT NULL COMMENT 'primary key for ballot.',
    candidate_id INT UNSIGNED NOT NULL COMMENT 'primary key for candidate',
    INDEX IDX_5A108564DDC23F6C (ballot_id),
    INDEX IDX_5A10856491BD8781 (candidate_id),
    PRIMARY KEY (ballot_id, candidate_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;



CREATE TABLE ballot_type
(
    ballot_type_id   INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for ballot_type',
    ballot_type      CHAR(128)                   NOT NULL COMMENT 'description of a ballot type.  ie, electronic, proxy, etc.',
    url_ballot_type  CHAR(128)   DEFAULT NULL COMMENT 'url link to get to page describing the ballot type',
    html_ballot_type TEXT        DEFAULT NULL COMMENT 'html describing the ballot type',
    is_active        TINYINT(1)  DEFAULT '1'     NOT NULL COMMENT 'is record active',
    deletedAt        DATETIME    DEFAULT NULL,
    created_from_ip  VARCHAR(45) DEFAULT NULL,
    updated_from_ip  VARCHAR(45) DEFAULT NULL,
    created_at       DATETIME                    NOT NULL,
    updated_at       DATETIME                    NOT NULL,
    PRIMARY KEY (ballot_type_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;



CREATE TABLE candidate
(
    candidate_id              INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for candidate',
    election_id               INT UNSIGNED DEFAULT NULL COMMENT 'primary key for election',
    is_write_in               TINYINT(1)                  NOT NULL COMMENT 'is record active',
    write_in_by_voter_id      INT UNSIGNED DEFAULT NULL COMMENT 'foreign key to voter',
    name_display              VARCHAR(108) DEFAULT NULL COMMENT 'display name',
    name_first                VARCHAR(32)                 NOT NULL COMMENT 'first name',
    name_middle               VARCHAR(32)  DEFAULT NULL COMMENT 'middle name',
    name_last                 VARCHAR(32)                 NOT NULL COMMENT 'last name',
    name_suffix               VARCHAR(12)  DEFAULT NULL COMMENT 'suffix',
    physical_address_line1    CHAR(128)                   NOT NULL COMMENT 'physical address line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city     CHAR(128)                   NOT NULL COMMENT 'physical address city',
    physical_address_state    CHAR(2)                     NOT NULL COMMENT 'physical address state',
    phone_mobile              CHAR(14)     DEFAULT NULL,
    email                     VARCHAR(128) DEFAULT NULL,
    display_candidate_address TINYINT(1)                  NOT NULL COMMENT 'display the candidates address?',
    share_write_in_name       TINYINT(1)                  NOT NULL COMMENT 'does the voter want to share the name of the write in they have entered?',
    is_active                 TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'is record active',
    deletedAt                 DATETIME     DEFAULT NULL,
    created_from_ip           VARCHAR(45)  DEFAULT NULL,
    updated_from_ip           VARCHAR(45)  DEFAULT NULL,
    created_at                DATETIME                    NOT NULL,
    updated_at                DATETIME                    NOT NULL,
    INDEX fk_idx_candidate_election_id (election_id),
    INDEX idx_candidate_name_last (name_last),
    INDEX idx_candidate_name_display (name_display),
    PRIMARY KEY (candidate_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;



CREATE TABLE company
(
    company_id                INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for company',
    person_id                 INT UNSIGNED DEFAULT NULL COMMENT 'primary key for person',
    company_name              CHAR(128)                   NOT NULL COMMENT 'name of the association',
    physical_address_line1    CHAR(128)                   NOT NULL COMMENT 'physical address line 1',
    physical_address_line2    CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city     CHAR(128)                   NOT NULL COMMENT 'physical address city',
    physical_address_state    CHAR(2)                     NOT NULL COMMENT 'physical address state',
    physical_address_zip_code CHAR(16)                    NOT NULL COMMENT 'physical address zip code',
    mailing_address_line1     CHAR(128)                   NOT NULL COMMENT 'mailing address line 1',
    mailing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city      CHAR(128)                   NOT NULL COMMENT 'mailing address city',
    mailing_address_state     CHAR(2)                     NOT NULL COMMENT 'mailing address state',
    mailing_address_zip_code  CHAR(16)                    NOT NULL COMMENT 'mailing address zip code',
    billing_address_line1     CHAR(128)                   NOT NULL COMMENT 'billing address line 1',
    billing_address_line2     CHAR(128)    DEFAULT NULL COMMENT 'billing address line 1',
    billing_address_city      CHAR(128)                   NOT NULL COMMENT 'billing address city',
    billing_address_state     CHAR(2)                     NOT NULL COMMENT 'billing address state',
    billing_address_zip_code  CHAR(16)                    NOT NULL COMMENT 'billing address zip code',
    phone_fax                 CHAR(14)     DEFAULT NULL,
    phone_work                CHAR(14)     DEFAULT NULL,
    url                       VARCHAR(256) DEFAULT NULL COMMENT 'Web Site address',
    is_active                 TINYINT(1)                  NOT NULL,
    deletedAt                 DATETIME     DEFAULT NULL,
    created_from_ip           VARCHAR(45)  DEFAULT NULL,
    updated_from_ip           VARCHAR(45)  DEFAULT NULL,
    created_at                DATETIME                    NOT NULL,
    updated_at                DATETIME                    NOT NULL,
    INDEX fk_idx_company_to_person_id (person_id),
    INDEX idx_company_physical_address_zip_code (physical_address_zip_code),
    INDEX idx_company_company_name (company_name),
    INDEX idx_company_billing_address_zip_code (billing_address_zip_code),
    INDEX idx_company_mailing_address_zip_code (mailing_address_zip_code),
    PRIMARY KEY (company_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;




CREATE TABLE election
(
    election_id                  INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for election',
    association_id               INT UNSIGNED DEFAULT NULL COMMENT 'primary key for association',
    election_type_id             INT UNSIGNED DEFAULT NULL COMMENT 'primary key for election_type',
    election_name_heading        CHAR(128)                   NOT NULL COMMENT 'line 1 text to describe the election',
    election_name_subheading     CHAR(128)    DEFAULT NULL COMMENT 'line 2 text to describe the election',
    url_election                 CHAR(128)    DEFAULT NULL COMMENT 'url link to get to page describing the election',
    html_election_information    TEXT                        NOT NULL COMMENT 'html describing the election',
    physical_address_line1       CHAR(128)                   NOT NULL COMMENT 'physical address line 1',
    physical_address_line2       CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city        CHAR(128)                   NOT NULL COMMENT 'physical address city',
    physical_address_state       CHAR(2)                     NOT NULL COMMENT 'physical address state',
    physical_address_zip_code    CHAR(16)                    NOT NULL COMMENT 'physical address zip code',
    display_physical_address     TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'Display the Physical Address on the form.',
    mailing_address_line1        CHAR(128)                   NOT NULL COMMENT 'mailing address line 1',
    mailing_address_line2        CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city         CHAR(128)                   NOT NULL COMMENT 'mailing address city',
    mailing_address_state        CHAR(2)                     NOT NULL COMMENT 'mailing address state',
    mailing_address_zip_code     CHAR(16)                    NOT NULL COMMENT 'mailing address zip code',
    display_mailing_address      TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'display the mailing address on the form.',
    votes_min                    SMALLINT UNSIGNED           NOT NULL COMMENT 'minimum amount of votes allowed for balot to be allowable. ',
    votes_max                    SMALLINT UNSIGNED           NOT NULL COMMENT 'maximum number of votes that can be cast. ',
    date_start                   DATETIME                    NOT NULL COMMENT 'date and time when voting starts',
    date_end                     DATETIME                    NOT NULL COMMENT 'date and time when voting ends',
    voters_total                 INT UNSIGNED                NOT NULL COMMENT 'Total number of voters.  This can be either total number of homes, or in the case of a ratification a certain percentage of home or subsection of a subdivision',
    voters_required_election     INT UNSIGNED                NOT NULL COMMENT 'Total number of votes required to make this election official.  This is usually a percentage of the number. ',
    voters_required_ratification INT UNSIGNED                NOT NULL COMMENT 'Total number of voters required to ratify a bylaw or a deed restriction',
    election_state               CHAR(2)      DEFAULT 'TX' NOT NULL COMMENT 'physical address state',
    allow_write_in_candidates    TINYINT(1)   DEFAULT NULL COMMENT 'Allow for Write In Candidates',
    allow_proxy_voting           TINYINT(1)   DEFAULT '1' COMMENT 'Allow for Proxy Votes',
    allow_proxy_directed         TINYINT(1)   DEFAULT NULL COMMENT 'Allow for Directed Proxies to be submitted.',
    allow_proxy_nondirected      TINYINT(1)   DEFAULT NULL COMMENT 'Allow for Non-Directed Proxies to be submitted.',
    is_active                    TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'is record active',
    deletedAt                    DATETIME     DEFAULT NULL,
    created_from_ip              VARCHAR(45)  DEFAULT NULL,
    updated_from_ip              VARCHAR(45)  DEFAULT NULL,
    created_at                   DATETIME                    NOT NULL,
    updated_at                   DATETIME                    NOT NULL,
    INDEX fk_idx_election_to_association (association_id),
    INDEX fk_idx_election_to_election_type (election_type_id),
    INDEX idx_election_date_start (date_start),
    INDEX idx_election_date_end (date_end),
    PRIMARY KEY (election_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;




CREATE TABLE election_date
(
    election_date_id INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for ellection_date',
    election_id      INT UNSIGNED DEFAULT NULL COMMENT 'primary key for election',
    date_value       DATETIME                    NOT NULL COMMENT 'date to display',
    date_label       VARCHAR(512)                NOT NULL COMMENT 'label to display with date',
    is_active        TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'is record active',
    deletedAt        DATETIME     DEFAULT NULL,
    created_from_ip  VARCHAR(45)  DEFAULT NULL,
    updated_from_ip  VARCHAR(45)  DEFAULT NULL,
    created_at       DATETIME                    NOT NULL,
    updated_at       DATETIME                    NOT NULL,
    INDEX idx_election_date_dates_and_election_id (election_id, date_label),
    INDEX fk_idx_election_date_election_id (election_id),
    PRIMARY KEY (election_date_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;



CREATE TABLE election_type
(
    election_type_id   INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for election_type',
    election_type      VARCHAR(512)                NOT NULL COMMENT 'descripton of election',
    url_election_type  CHAR(128)   DEFAULT NULL COMMENT 'url link to get to page describing the election',
    html_election_type TEXT        DEFAULT NULL COMMENT 'html describing the election type',
    is_active          TINYINT(1)  DEFAULT '1'     NOT NULL COMMENT 'is record active',
    deletedAt          DATETIME    DEFAULT NULL,
    created_from_ip    VARCHAR(45) DEFAULT NULL,
    updated_from_ip    VARCHAR(45) DEFAULT NULL,
    created_at         DATETIME                    NOT NULL,
    updated_at         DATETIME                    NOT NULL,
    PRIMARY KEY (election_type_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;



CREATE TABLE person
(
    id                           INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for person',
    person_type_id               INT UNSIGNED DEFAULT NULL COMMENT 'Primary Key to Person_Type',
    name_display                 VARCHAR(108) DEFAULT NULL COMMENT 'display name',
    name_first                   VARCHAR(32)                 NOT NULL COMMENT 'first name',
    name_middle                  VARCHAR(32)  DEFAULT NULL COMMENT 'middle name',
    name_last                    VARCHAR(32)                 NOT NULL COMMENT 'last name',
    name_suffix                  VARCHAR(12)  DEFAULT NULL COMMENT 'suffix',
    phone_mobile                 CHAR(14)     DEFAULT NULL,
    phone_home                   CHAR(14)     DEFAULT NULL,
    phone_work                   CHAR(14)     DEFAULT NULL,
    phone_fax                    CHAR(14)     DEFAULT NULL,
    email                        VARCHAR(180)                NOT NULL,
    mailing_address_line1        CHAR(128)                   NOT NULL COMMENT 'mailing address line 1',
    mailing_address_line2        CHAR(128)    DEFAULT NULL COMMENT 'mailing address line 1',
    mailing_address_city         CHAR(128)                   NOT NULL COMMENT 'mailing address city',
    mailing_address_state        CHAR(2)                     NOT NULL COMMENT 'mailing address state',
    mailing_address_zip_code     CHAR(16)                    NOT NULL COMMENT 'mailing address zip code',
    mailing_address_country      CHAR(2)      DEFAULT NULL COMMENT 'mailing address country code',
    physical_address_line1       CHAR(128)                   NOT NULL COMMENT 'physical address line 1',
    physical_address_line2       CHAR(128)    DEFAULT NULL COMMENT 'physical address line 1',
    physical_address_city        CHAR(128)                   NOT NULL COMMENT 'physical address city',
    physical_address_state       CHAR(2)                     NOT NULL COMMENT 'physical address state',
    physical_address_zip_code    CHAR(16)                    NOT NULL COMMENT 'physical address zip code',
    password                     VARCHAR(255) DEFAULT NULL,
    password_recovery_key        CHAR(32)     DEFAULT NULL COMMENT 'Key to be included in the verification email',
    password_recovery_date       DATETIME     DEFAULT NULL COMMENT 'Date password recovery was made.',
    password_recovery_ip_address CHAR(39)     DEFAULT NULL COMMENT 'IP Address where the password request was made.',
    ip_address                   CHAR(39)     DEFAULT NULL COMMENT 'ip address where the Person was submitted from.',
    roles                        JSON         DEFAULT NULL,
    verification_key             CHAR(32)     DEFAULT NULL COMMENT 'Key to be included in the verification email',
    verification_date            DATETIME     DEFAULT NULL COMMENT 'Date and time verification of email address was performed.',
    verification_ip_address      CHAR(39)     DEFAULT NULL COMMENT 'IP Address where the verification was made from.',
    has_started_registration     TINYINT(1)                  NOT NULL COMMENT 'Has this person started registration',
    is_active                    TINYINT(1)                  NOT NULL COMMENT 'is record active',
    is_verified                  TINYINT(1)                  NOT NULL COMMENT 'is email address verified',
    is_registered                TINYINT(1)                  NOT NULL COMMENT 'is record registered',
    agreed_to_terms_at           DATETIME     DEFAULT NULL COMMENT 'ts when tos was agreed to',
    terms_id                     INT UNSIGNED DEFAULT NULL COMMENT 'Future Forein Key field to more complex legal framework.',
    deletedAt                    DATETIME     DEFAULT NULL,
    created_from_ip              VARCHAR(45)  DEFAULT NULL,
    updated_from_ip              VARCHAR(45)  DEFAULT NULL,
    created_at                   DATETIME                    NOT NULL,
    updated_at                   DATETIME                    NOT NULL,
    UNIQUE INDEX UNIQ_34DCD176E7927C74 (email),
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
    person_type_id    INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'Primary Key to Person_Type',
    person_type_key   TEXT                        NOT NULL COMMENT 'Long Description of Person Type',
    person_type_value CHAR(255)   DEFAULT NULL COMMENT 'Short Description of Person Type',
    is_active         TINYINT(1)  DEFAULT '1'     NOT NULL COMMENT 'Is this Record Active',
    deletedAt         DATETIME    DEFAULT NULL,
    created_from_ip   VARCHAR(45) DEFAULT NULL,
    updated_from_ip   VARCHAR(45) DEFAULT NULL,
    created_at        DATETIME                    NOT NULL,
    updated_at        DATETIME                    NOT NULL,
    PRIMARY KEY (person_type_id)
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
    upload_id       INT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT 'primary key for uploaded file',
    file_path       CHAR(128)                   NOT NULL,
    file_name       CHAR(64)                    NOT NULL,
    file_extension  CHAR(4)                     NOT NULL,
    file_size       INT UNSIGNED DEFAULT NULL COMMENT 'size of the file in bytes',
    image_width     INT UNSIGNED DEFAULT NULL COMMENT 'width of the image',
    image_height    INT UNSIGNED DEFAULT NULL COMMENT 'height of the image',
    is_image        TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'is file and image',
    uploaded_by     INT UNSIGNED                NOT NULL COMMENT 'foreign key to person',
    is_active       TINYINT(1)   DEFAULT '1'    NOT NULL COMMENT 'is record active',
    deletedAt       DATETIME     DEFAULT NULL,
    created_from_ip VARCHAR(45)  DEFAULT NULL,
    updated_from_ip VARCHAR(45)  DEFAULT NULL,
    created_at      DATETIME                    NOT NULL,
    updated_at      DATETIME                    NOT NULL,
    PRIMARY KEY (upload_id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;





ALTER TABLE property
    ADD CONSTRAINT FK_8BF21CDEEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (association_id);
ALTER TABLE property
    ADD CONSTRAINT FK_8BF21CDE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES person (id);
ALTER TABLE voter
    ADD CONSTRAINT FK_268C4A59A708DAFF FOREIGN KEY (election_id) REFERENCES election (election_id);
ALTER TABLE voter
    ADD CONSTRAINT FK_268C4A59549213EC FOREIGN KEY (property_id) REFERENCES property (property_id);
ALTER TABLE voter
    ADD CONSTRAINT FK_268C4A59DB494898 FOREIGN KEY (proxy_person_id) REFERENCES person (id);
ALTER TABLE association
    ADD CONSTRAINT FK_FD8521CC979B1AD6 FOREIGN KEY (company_id) REFERENCES company (company_id);
ALTER TABLE association
    ADD CONSTRAINT FK_FD8521CCDDD880E9 FOREIGN KEY (management_company_id) REFERENCES company (company_id);
ALTER TABLE association_staff
    ADD CONSTRAINT FK_354661FFEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (association_id);
ALTER TABLE association_staff
    ADD CONSTRAINT FK_354661FF217BBB47 FOREIGN KEY (person_id) REFERENCES person (id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BD417E6B4D FOREIGN KEY (ballot_type_id) REFERENCES ballot_type (ballot_type_id);
ALTER TABLE ballot
    ADD CONSTRAINT FK_D59CE9BDEBB4B8AD FOREIGN KEY (voter_id) REFERENCES voter (voter_id);
ALTER TABLE vote
    ADD CONSTRAINT FK_5A108564DDC23F6C FOREIGN KEY (ballot_id) REFERENCES ballot (ballot_id);
ALTER TABLE vote
    ADD CONSTRAINT FK_5A10856491BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (candidate_id);
ALTER TABLE candidate
    ADD CONSTRAINT FK_C8B28E44A708DAFF FOREIGN KEY (election_id) REFERENCES election (election_id);
ALTER TABLE company
    ADD CONSTRAINT FK_4FBF094F217BBB47 FOREIGN KEY (person_id) REFERENCES person (id);
ALTER TABLE election
    ADD CONSTRAINT FK_DCA03800EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (association_id);
ALTER TABLE election
    ADD CONSTRAINT FK_DCA038007F91056D FOREIGN KEY (election_type_id) REFERENCES election_type (election_type_id);
ALTER TABLE election_date
    ADD CONSTRAINT FK_36D1405CA708DAFF FOREIGN KEY (election_id) REFERENCES election (election_id);
ALTER TABLE person
    ADD CONSTRAINT FK_34DCD176E7D23F1A FOREIGN KEY (person_type_id) REFERENCES person_type (person_type_id);
























































































































































