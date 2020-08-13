SELECT COUNT(*)
FROM property
WHERE (property.association_id = :association_id)
  AND (property.is_active > 0)
