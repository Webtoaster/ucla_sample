SELECT TABLE_NAME               AS 'TABLE'
     , ORDINAL_POSITION         AS 'POSITION'
     , COLUMN_NAME              AS 'COL NAME'
     , DATA_TYPE                AS 'DATA TYPE'
     , COLUMN_DEFAULT           AS 'DEFAULT VALUE'
     , IS_NULLABLE              AS 'IS NULLABLE'
     , CHARACTER_MAXIMUM_LENGTH AS 'MAX LENGTH'
     , COLUMN_TYPE              AS 'COL TYPE'
     , COLUMN_KEY               AS 'COL KEY'
     , COLUMN_COMMENT           AS 'Label'
-- TABLE_CATALOG
-- ,TABLE_SCHEMA
-- ,TABLE_NAME
-- ,COLUMN_NAME
-- ,CHARACTER_OCTET_LENGTH
-- ,NUMERIC_PRECISION
-- ,NUMERIC_SCALE
-- ,DATETIME_PRECISION
-- ,CHARACTER_SET_NAME
-- ,COLLATION_NAME
-- ,EXTRA
-- ,PRIVILEGES
-- ,IS_GENERATED
-- ,GENERATION_EXPRESSION


FROM information_schema.COLUMNS
WHERE 

  TABLE_SCHEMA = 'hoa'

-- AND TABLE_NAME = 'import'


  AND COLUMN_NAME NOT IN ('is_active', 'updated_at', 'created_at', 'ip_address', 'password', 'password_recovery_key',
                          'password_recovery_date', 'password_recovery_ip_address', 'verification_key',
                          'verification_ip_address', 'has_started_registration', 'agreed_to_terms_at', 'terms_id')
  AND TABLE_NAME != 'Sessions'
ORDER BY TABLE_NAME
       , ORDINAL_POSITION;
