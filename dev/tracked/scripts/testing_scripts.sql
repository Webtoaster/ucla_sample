-- 	Testing Scripts


SET FOREIGN_KEY_CHECKS = 0;

-- TRUNCATE TABLE person;
-- TRUNCATE TABLE security_user;

delete
from person
where id > 4;


SET FOREIGN_KEY_CHECKS = 1;


-- /Testing Scripts

SELECT id
     , name_display
     , name_first
     , name_middle
     , name_last

     , roles

     , verification_key
     , verification_date
     , verification_ip_address
     , updated_at
     , created_at
     , has_started_registration
     , is_active
     , is_verified
     , is_registered
     , agreed_to_terms_at
     , terms_id
     , password
     , password_recovery_key
     , password_recovery_date
     , password_recovery_ip_address


     , name_suffix
     , phone_home
     , phone_mobile
     , phone_fax
     , phone_work
     , phone_work_extension
     , email
     , mailing_address_line1
     , mailing_address_line2
     , mailing_address_city
     , mailing_address_state
     , mailing_address_zip_code
     , mailing_address_country
     , physical_address_line1
     , physical_address_line2
     , physical_address_city
     , physical_address_state
     , physical_address_zip_code
     , ip_address

FROM hoa.person;
