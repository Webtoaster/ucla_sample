SELECT t0.id                           AS id_1,
       t0.pw                           AS pw_2,
       t0.password_recovery_key        AS password_recovery_key_3,
       t0.password_recovery_date       AS password_recovery_date_4,
       t0.password_recovery_ip_address AS password_recovery_ip_address_5,
       t0.roles                        AS roles_6,
       t0.verification_key             AS verification_key_7,
       t0.verification_date            AS verification_date_8,
       t0.verification_ip_address      AS verification_ip_address_9,
       t0.has_started_registration     AS has_started_registration_10,
       t0.is_verified                  AS is_verified_11,
       t0.is_registered                AS is_registered_12,
       t0.agreed_to_terms_at           AS agreed_to_terms_at_13,
       t0.terms_id                     AS terms_id_14,
       t0.name_formal                  AS name_formal_15,
       t0.name_first                   AS name_first_16,
       t0.name_middle                  AS name_middle_17,
       t0.name_last                    AS name_last_18,
       t0.name_suffix                  AS name_suffix_19,
       t0.mailing_address_line1        AS mailing_address_line1_20,
       t0.mailing_address_line2        AS mailing_address_line2_21,
       t0.mailing_address_city         AS mailing_address_city_22,
       t0.mailing_address_state        AS mailing_address_state_23,
       t0.mailing_address_zip_code     AS mailing_address_zip_code_24,
       t0.mailing_address_country      AS mailing_address_country_25,
       t0.physical_address_line1       AS physical_address_line1_26,
       t0.physical_address_line2       AS physical_address_line2_27,
       t0.physical_address_city        AS physical_address_city_28,
       t0.physical_address_state       AS physical_address_state_29,
       t0.physical_address_zip_code    AS physical_address_zip_code_30,
       t0.email                        AS email_31,
       t0.un                           AS un_32,
       t0.phone_home                   AS phone_home_33,
       t0.phone_work                   AS phone_work_34,
       t0.phone_mobile                 AS phone_mobile_35,
       t0.phone_fax                    AS phone_fax_36,
       t0.created_from_ip              AS created_from_ip_37,
       t0.updated_from_ip              AS updated_from_ip_38,
       t0.created_at                   AS created_at_39,
       t0.updated_at                   AS updated_at_40,
       t0.is_active                    AS is_active_41,
       t0.person_type_id               AS person_type_id_42
FROM person t0
WHERE t0.verification_key = '548eafb74f0b2bae4e8726989cc4bf2'
LIMIT 1
;

SELECT *
FROM permission
;

SELECT *
FROM company
;

SELECT *
FROM person
;

SELECT *
FROM relationship
;



DELETE
FROM company
WHERE company_id = 2
;

SET FOREIGN_KEY_CHECKS = 0
;

TRUNCATE TABLE person
;

SET FOREIGN_KEY_CHECKS = 1
;

SELECT *
FROM person
;



SET FOREIGN_KEY_CHECKS = 0
;

INSERT INTO hoa.company( company_id
	--   ,person_id
                       , number_of_sections
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
                       , mailing_address_country
                       , display_mailing_address
                       , display_billing_address
                       , phone_work
                       , phone_fax
                       , created_from_ip
                       , updated_from_ip
                       , created_at
                       , updated_at
                       , is_active)


SELECT `Taxpayer Number`                   AS company_id

	 , FLOOR(RAND() * (20 - 5 + 1) + 1)    AS number_of_sections
	 , FLOOR(RAND() * (2500 - 5 + 1) + 10) AS number_of_properties
	 , Name                                AS name_formal
	 , Address                             AS physical_address_line_1
	 , City                                AS physical_address_city
	 , State                               AS physical_address_state
	 , `Zip Code`                          AS physical_address_zipcode
	 , Address                             AS mailing_address_line_1
	 , City                                AS mailing_address_city
	 , State                               AS mailing_address_state
	 , `Zip Code`                          AS mailing_address_zipcode


	 , 0                                      is_management_company
	 , 1                                   AS is_association_company

	 , 1                                   AS display_physical_address
	 , 1                                   AS display_mailing_address
	 , 1                                   AS display_billing_address
	 , NULL                                   phone_work
	 , NULL                                   phone_fax
	 , NULL                                   url
	 , '127.0.0.1'                         AS created_from_ip
	 , '127.0.0.1'                         AS updated_from_ip
	 , NOW()                               AS created_at
	 , NOW()                               AS updated_at
	 , 1                                   AS is_active


FROM skeleton.exempts
WHERE
   --
   -- Name like '%homeowners%'
   -- OR
   -- Name like '%Property Owners%'
   --
   -- OR
   -- Name like '%HOA%'
   --
   -- OR
   -- Name like '%CIA%'

   --
   -- Name like '%Association%'
   -- OR
	(Name LIKE '%Condo%' AND
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



INSERT INTO hoa.company
(person_id, number_of_sections, number_of_properties, is_management_company, is_association_company, name_formal, physical_address_line1, physical_address_line2,
 physical_address_city, physical_address_state, physical_address_zip_code, display_physical_address, mailing_address_line1, mailing_address_line2, mailing_address_city,
 mailing_address_state, mailing_address_zip_code, mailing_address_country, display_mailing_address, billing_address_line1, billing_address_line2, billing_address_city,
 billing_address_state, billing_address_zip_code, display_billing_address, phone_work, phone_fax, url, created_from_ip, updated_from_ip, created_at, updated_at, is_active)

SELECT person_id,
       number_of_sections,
       number_of_properties,
       is_management_company,
       is_association_company,
       name_formal,
       physical_address_line1,
       physical_address_line2,
       physical_address_city,
       physical_address_state,
       physical_address_zip_code,
       display_physical_address,
       mailing_address_line1,
       mailing_address_line2,
       mailing_address_city,
       mailing_address_state,
       mailing_address_zip_code,
       mailing_address_country,
       display_mailing_address,
       billing_address_line1,
       billing_address_line2,
       billing_address_city,
       billing_address_state,
       billing_address_zip_code,
       display_billing_address,
       phone_work,
       phone_fax,
       url,
       created_from_ip,
       updated_from_ip,
       created_at,
       updated_at,
       is_active
FROM skeleton.company
;



SET FOREIGN_KEY_CHECKS = 1
;










