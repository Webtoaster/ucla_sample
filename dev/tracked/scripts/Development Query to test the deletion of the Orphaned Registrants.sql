SET time_zone = 'America/Chicago';


SELECT id
     , UTC_TIMESTAMP()
     , now()                                    AS right_now
     , CURRENT_TIMESTAMP - INTERVAL 3600 SECOND AS one_hour_ago
     , created_at                               AS created_at
     , name_display
-- ,name_first
-- ,name_middle
-- ,name_last
-- ,name_suffix
-- ,phone_home
-- ,phone_mobile
-- ,phone_fax
-- ,phone_work
-- ,phone_work_extension
-- ,email
-- ,mailing_address_line1
-- ,mailing_address_line2
-- ,mailing_address_city
-- ,mailing_address_state
-- ,mailing_address_zip_code
-- ,mailing_address_country
-- ,physical_address_line1
-- ,physical_address_line2
-- ,physical_address_city
-- ,physical_address_state
-- ,physical_address_zip_code
-- ,ip_address
-- ,roles
-- ,password
-- ,password_recovery_key
-- ,password_recovery_date
-- ,password_recovery_ip_address
-- ,verification_key
-- ,verification_date
-- ,verification_ip_address
-- ,updated_at
-- ,created_at
-- ,has_started_registration
-- ,is_active
-- ,is_verified
-- ,is_registered
FROM hoa.person
WHERE hoa.person.has_started_registration = 1
  AND hoa.person.is_verified = 0
  AND hoa.person.created_at < CURRENT_TIMESTAMP - INTERVAL 3600 SECOND
ORDER BY hoa.person.created_at DESC
;


SET time_zone = 'America/Chicago';

DELETE
FROM person
WHERE person.has_started_registration = 1
  AND person.is_verified = 0
  AND person.created_at < CURRENT_TIMESTAMP - INTERVAL 3600 SECOND;
;
