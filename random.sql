

SELECT type, COUNT(*) as typeCount
FROM location
JOIN (
    SELECT * FROM photoTakenAtLocation JOIN AlbumHasPhoto USING (photoID)
) USING (locationID)
GROUP BY type
ORDER BY typeCount DESC;
