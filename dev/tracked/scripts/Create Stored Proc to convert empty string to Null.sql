DROP PROCEDURE IF EXISTS convertEmptyStringToNull;

DELIMITER $$

CREATE PROCEDURE convertEmptyStringToNull()
BEGIN
    DECLARE i, num_rows INT;
    DECLARE col_name char(250);

    DECLARE
        col_names CURSOR FOR
            SELECT column_name
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE table_name = 'import'
            ORDER BY ordinal_position;

    OPEN col_names;

    SELECT FOUND_ROWS()
    INTO
        num_rows;

    SET i = 1;

    the_loop:
    LOOP
        IF i > num_rows
        THEN
            CLOSE col_names;

            LEAVE the_loop;
        END IF;

        FETCH col_names
            INTO
                col_name;

        SET @command_text = CONCAT(
                'UPDATE `import` SET '
            , col_name
            , '= IF(LENGTH('
            , col_name
            , ')=0, NULL,'
            , col_name
            , ') WHERE 1 ;');

        --      UPDATE `import` SET col_name=IF(LENGTH(col_name)=0,NULL,col_name) WHERE 1;
        --      This won't work, because MySQL doesn't take varibles as column name.

        PREPARE stmt FROM @command_text;

        EXECUTE stmt;

        SET i = i + 1;
    END LOOP the_loop;
END
$$

DELIMITER ;

-- call processallcolumns ();
-- DROP PROCEDURE processallcolumns;