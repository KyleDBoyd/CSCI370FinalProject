<html>
<head>
<title>Create Album</title>
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

        $userID = $_SESSION['userID'];
        $albumName = $_POST['albumName'];
  
        $stmt = $file_db->prepare('INSERT INTO album (name)  
                                   VALUES(:albumName)');

        $stmt->bindParam(':albumName', $albumName);
        $stmt->execute();

        //Grab groupID from last insert
        $albumID = $file_db->lastinsertID();

        $stmt2 = $file_db->prepare('INSERT INTO userCreateAlbum (userID, albumID)
                                   VALUES(:userID, :albumID)');

        $stmt2->bindParam(':userID', $userID);
        $stmt2->bindParam(':albumID', $albumID);
        $stmt2->execute();

        $stmt3 = $file_db->prepare('INSERT INTO userPermissionsAlbum (userID, albumID)
                                   VALUES(:userID, :albumID)');

        $stmt3->bindParam(':userID', $userID);
        $stmt3->bindParam(':albumID', $albumID);
        $stmt3->execute();

        // Close file db connection
        $file_db = null;

        echo "Album created sucessfully. <br />";

        echo '<a href="index.php">Back to Home</a>';

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
        
        $_SESSION['userID'] = $userID;

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
