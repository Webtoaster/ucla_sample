INSERT INTO hoa.permission( permission_id
                          , permission_group
                          , description_short
                          , description_long
                          , display_description_long
                          , created_from_ip
                          , updated_from_ip
                          , created_at
                          , updated_at
                          , is_active)
VALUES ( 1
       , NULL -- permission_group - IN longtext
       , 'SuperUser' -- description_short - IN char(255)
       , 'Owner of the Website, HMFIC' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 100
       , NULL -- permission_group - IN longtext
       , 'Site Administrator' -- description_short - IN char(255)
       , 'Administrator of the Website, NOT the HMFIC' -- description_long - IN text
       , 0 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 500
       , NULL -- permission_group - IN longtext
       , 'Customer Service Supervisor' -- description_short - IN char(255)
       , 'Use in charge of CSR' -- description_long - IN text
       , 0 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),

       ( 550
       , NULL -- permission_group - IN longtext
       , 'Customer Service Representative' -- description_short - IN char(255)
       , 'Customer Service Representative' -- description_long - IN text
       , 0 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 1000
       , NULL -- permission_group - IN longtext
       , 'Company Owner' -- description_short - IN char(255)
       , 'Originator of the Site Account and Super User over the Company' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 1010
       , NULL -- permission_group - IN longtext
       , 'Create Company User' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 1020
       , NULL -- permission_group - IN longtext
       , 'Edit Company User' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 1030
       , NULL -- permission_group - IN longtext
       , 'Remove Company User' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 2010
       , NULL -- permission_group - IN longtext
       , 'Create Association' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),

       ( 2020
       , NULL -- permission_group - IN longtext
       , 'Edit Association' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),

       ( 2030
       , NULL -- permission_group - IN longtext
       , 'Remove Association' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 3010
       , NULL -- permission_group - IN longtext
       , 'Create Association User' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 3020
       , NULL -- permission_group - IN longtext
       , 'Edit Association User' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 3030
       , NULL -- permission_group - IN longtext
       , 'Remove Association User' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 4010
       , NULL -- permission_group - IN longtext
       , 'Administer Election' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 4020
       , NULL -- permission_group - IN longtext
       , 'Audit Election' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 4030
       , NULL -- permission_group - IN longtext
       , 'Supervise Election' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 4150
       , NULL -- permission_group - IN longtext
       , 'Upload Property Data' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),

       ( 4160
       , NULL -- permission_group - IN longtext
       , 'Edit Property' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 4170
       , NULL -- permission_group - IN longtext
       , 'Remove Property' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       ),


       ( 5010
       , NULL -- permission_group - IN longtext
       , 'Print Proxy' -- description_short - IN char(255)
       , '' -- description_long - IN text
       , 1 -- display_description_long - IN tinyint(1)
       , '127.0.0.1' -- created_from_ip - IN varchar(45)
       , '127.0.0.1' -- updated_from_ip - IN varchar(45)
       , NOW() -- created_at - IN datetime
       , NOW() -- updated_at - IN datetime
       , 1 -- is_active - IN tinyint(1)
       )
;








