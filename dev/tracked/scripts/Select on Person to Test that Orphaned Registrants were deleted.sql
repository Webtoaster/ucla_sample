SELECT count(*)
FROM person;


SELECT id
     , UTC_TIMESTAMP()
     , now()                                    AS right_now
     , CURRENT_TIMESTAMP - INTERVAL 3600 SECOND AS one_hour_ago
     , created_at                               AS created_at
     , name_display
FROM hoa.person
WHERE hoa.person.has_started_registration = 1
  AND hoa.person.is_verified = 0
  AND hoa.person.created_at > CURRENT_TIMESTAMP - INTERVAL 3600 SECOND
ORDER BY hoa.person.created_at DESC;


SELECT id
     , UTC_TIMESTAMP()
     , now()                                    AS right_now
     , CURRENT_TIMESTAMP - INTERVAL 3600 SECOND AS one_hour_ago
     , created_at                               AS created_at
     , name_display
FROM hoa.person
WHERE hoa.person.has_started_registration = 1
  AND hoa.person.is_verified = 0
  AND hoa.person.created_at < CURRENT_TIMESTAMP - INTERVAL 3600 SECOND
ORDER BY hoa.person.created_at DESC;
