-- SET time_zone = 'America/Chicago';
-- SELECT SUBTIME(CURRENT_TIMESTAMP,'0 1:30:00.000000');


USE hoa;



SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE person;
SET FOREIGN_KEY_CHECKS = 1;

SET time_zone = 'America/Chicago';

INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        '2019-06-26 17:54:35', 1, 0, 0, 1);


INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 1:30:00.000000'), 1, 0, 0, 1);

INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 1:00:00.000000'), 1, 0, 0, 1);

INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 0:45:00.000000'), 1, 0, 0, 1);

INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 2:30:00.000000'), 1, 0, 0, 1);


INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 0:10:00.000000'), 1, 0, 0, 1);


INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 0:15:00.000000'), 1, 0, 0, 1);

INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 0:05:00.000000'), 1, 0, 0, 1);

INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 3:30:00.000000'), 1, 0, 0, 1);

INSERT INTO person(name_display, name_first, name_middle, name_last, name_suffix, phone_home, phone_mobile, phone_fax,
                   phone_work, phone_work_extension, email, mailing_address_line1, mailing_address_line2,
                   mailing_address_city, mailing_address_state, mailing_address_zip_code, mailing_address_country,
                   physical_address_line1, physical_address_line2, physical_address_city, physical_address_state,
                   physical_address_zip_code, ip_address, roles, password, password_recovery_key,
                   password_recovery_date, password_recovery_ip_address, verification_key, verification_date,
                   verification_ip_address, updated_at, created_at, has_started_registration, is_active, is_verified,
                   is_registered)
VALUES ('Tom Olson', 'Tom', '', 'Olson', null, '2812362506', '2812362506', null, '2812362506', null,
        'olson@webtoaster.com', null, null, null, null, null, null, null, null, null, null, null, '172.16.238.1', null,
        '$argon2i$v=19$m=65536,t=6,p=1$wEI81ZdZ/oXZDglaJ6cfxQ$tuOBKw4yDrw4TVIQbxHIYCs0Nj5CzA0A/L16vSg/dho', null, null,
        null, null, null, null, null,
        SUBTIME(CURRENT_TIMESTAMP, '0 4:30:00.000000'), 1, 0, 0, 1);
