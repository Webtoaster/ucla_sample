SELECT table_name,
       column_name,
       CONCAT('=CONCAT(" ALTER TABLE `',
              table_name,
              '` CHANGE `',
              column_name,
              '` `',
              column_name,
              '` ',
              column_type,
              ' ',
              IF(is_nullable = 'YES', '', 'NOT NULL '),
              IF(column_default IS NOT NULL, concat('DEFAULT ', IF(column_default = 'CURRENT_TIMESTAMP', column_default,
                                                                   CONCAT('\'', column_default, '\'')), ' '), ''),
              IF(column_default IS NULL AND is_nullable = 'YES' AND column_key = '' AND column_type = 'timestamp',
                 'NULL ', ''),
              IF(column_default IS NULL AND is_nullable = 'YES' AND column_key = '', 'DEFAULT NULL ', ''),
              extra,
              ' COMMENT \''
           )  as script,

       '\' ;' as script_end


FROM information_schema.columns
WHERE TABLE_SCHEMA = 'hoa'
  AND table_name != 'migration_versions'
  AND table_name != 'sessions'
  AND COLUMN_NAME NOT IN ('is_active', 'updated_at', 'created_at', 'ip_address', 'password', 'password_recovery_key',
                          'password_recovery_date', 'password_recovery_ip_address', 'verification_key',
                          'verification_ip_address', 'has_started_registration', 'agreed_to_terms_at', 'terms_id')


ORDER BY table_name
       , ORDINAL_POSITION;
