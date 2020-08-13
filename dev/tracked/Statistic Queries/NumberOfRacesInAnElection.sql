SELECT count(*)
FROM race
WHERE election_id = 5
  AND is_active > 0
