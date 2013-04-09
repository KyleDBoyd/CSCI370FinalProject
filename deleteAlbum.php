<html>
<head>
<title>Delete Group</title>
</head>
<body>
<?php

    //Start session
    session_start();
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);
        //Get current user's ID
        $userID = $_SESSION['userID'];

        $albumName = $_SESSION['albumName'];
        
        $stmt = $file_db->prepare('SELECT albumID      
                                   FROM album
                                   WHERE name = :albumName');

        $stmt->bindParam(':albumName', $albumName);
        $stmt->execute();
        $row = $stmt->fetch();
        $albumID = $row['albumID'];

        //Delete all photos in the given album
        $stmt2 = $file_db->prepare('DELETE
                                    FROM photo
                                    WHERE photoID in 
                                        (SELECT photoID
                                         FROM albumHasPhoto
                                         WHERE albumID = :albumID');
        $stmt2->bindParam(':albumID', $albumID);
        $stmt2->execute();


        //Delete Album from relations

        $stmt3 = $file_db->prepare('DELETE
                                    FROM groupHasPermissionAlbum
                                    WHERE albumID = :albumID'); 
        
        $stmt3->bindParam(':albumID', $albumID);
        $stmt3->execute();

        $stmt4 = $file_db->prepare('DELETE
                                    FROM userCreateAlbum
                                    WHERE albumID = :albumID');

        $stmt4->bindParam(':albumID', $albumID);
        $stmt4->execute();

        $stmt5 = $file_db->prepare('DELETE
                                    FROM userPermissionsAlbum
                                    WHERE groupID = albumID');

        $stmt5->bindParam(':albumID', $albumID);
        $stmt5->execute();

         //Delete Group 

        $stmt6 = $file_db->prepare('DELETE
                                    FROM album
                                    WHERE albumID = :albumID');

        $stmt6->bindParam(':albumID', $albumID);
        $stmt6->execute();

        echo "Album Deleted Successfully</br>";
        echo '</br><a href="index.php">Back to Home</a>';

        $file_db = null;

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
        
        if(!($userID)) {
            header("Location: login.html");
        }
            
    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
?>

</body>
</html>
