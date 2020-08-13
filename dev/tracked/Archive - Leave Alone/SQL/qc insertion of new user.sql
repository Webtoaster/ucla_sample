SELECT person_id,
       name_display,
       name_first,
       name_middle,
       name_last,
       name_suffix,
       phone_home,
       phone_mobile,
       phone_fax,
       phone_work,
       phone_work_extension,
       email,
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
       ip_address,
       updated_at,
       created_at,
       is_active
FROM hoa.person;
SELECT id, email, roles, password, person_id, ip_address
FROM hoa.security_user;


--   ---------------------------------

SET FOREIGN_KEY_CHECKS = 0;

truncate table person;
truncate table security_user;

SET FOREIGN_KEY_CHECKS = 1;