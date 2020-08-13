use information_schema;


select

-- distinct(column_name) ,


CONCAT('{{ form_row(form.', column_name, ') }}') as test

from columns
where TABLE_SCHEMA = 'hoa'
ORDER BY TABLE_NAME, COLUMN_NAME
;