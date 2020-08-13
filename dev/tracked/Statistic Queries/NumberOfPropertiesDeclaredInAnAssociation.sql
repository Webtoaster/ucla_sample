SELECT company.number_of_properties
FROM hoa.association association
         RIGHT OUTER JOIN hoa.company company
                          ON (association.company_id = company.company_id)
WHERE (association.association_id = :association_id)
