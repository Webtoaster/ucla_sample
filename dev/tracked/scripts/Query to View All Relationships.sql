SELECT
 relationship.relationship_id as relationship_id
,management_company.company_id as company_id
,management_company.name_formal as management_company_name
,association.company_id as associaton_id
,association.name_formal as association_name
,`pseudo-user`.id as  user_id
,`pseudo-user`.name_formal as user_name 
,`pseudo-user`.name_first as user_first_name
,`pseudo-user`.name_last as user_last_name
,supervisor.id as supervisor_id
,supervisor.name_formal as supervisor_name
,supervisor.name_first as supervisor_first_name
,supervisor.name_last as supervisor_last_name
,permission.permission_id as permission_id
,permission.description_short as permission_decription
,relationship_type.relationship_type_id as  relationship_type_id
,relationship_type.description_short as relationship_description
FROM
 (((((hoa.relationship relationship
      LEFT OUTER JOIN hoa.person supervisor
        ON (relationship.supervisor_id = supervisor.id))
     LEFT OUTER JOIN hoa.company association
       ON (relationship.association_id = association.company_id))
    LEFT OUTER JOIN hoa.company management_company
      ON (relationship.company_id = management_company.company_id))
   LEFT OUTER JOIN hoa.person `pseudo-user`
     ON (relationship.person_id = `pseudo-user`.id))
  LEFT OUTER JOIN hoa.permission permission
    ON (relationship.permission_id = permission.permission_id))
 LEFT OUTER JOIN hoa.relationship_type relationship_type
   ON (relationship.relationship_type_id =
       relationship_type.relationship_type_id)