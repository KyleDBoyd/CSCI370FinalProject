Select type
from location
where locationID in
    (SELECT locationID
     FROM photoTakenAtLocation
     WHERE photoID in
     (SELECT photoID
      FROM albumHasPhoto))
ORDER BY type;
