SELECT count(association.association_id) AS `count`
       --  association.association_id
       -- ,company.person_id
FROM association association
	     LEFT OUTER JOIN company company
	                     ON (association.company_id = company.company_id)
WHERE company.person_id = 5

