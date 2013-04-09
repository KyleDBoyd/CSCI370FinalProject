<html>
<head>
<title>Delete Member</title>
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

        $groupName = $_SESSION['groupName'];
        
        $stmt = $file_db->prepare('SELECT groupID      
                                   FROM photoGroup
                                   WHERE name = :groupName');

        $stmt->bindParam(':groupName', $groupName);
        $stmt->execute();
        $row = $stmt->fetch();
        $groupID = $row['groupID'];

        //Delete Group from relations

        $stmt2 = $file_db->prepare('DELETE
                                    FROM groupHasPermissionAlbum
                                    WHERE groupID = :groupID'); 
        
        $stmt2->bindParam(':groupID', $groupID);
        $stmt2->execute();

        $stmt3 = $file_db->prepare('DELETE
                                    FROM groupHasPermissionPhoto
                                    WHERE groupID = :groupID');

        $stmt3->bindParam(':groupID', $groupID);
        $stmt3->execute();

        //Delete Group 

        $stmt4 = $file_db->prepare('DELETE
                                    FROM photoGroup
                                    WHERE groupID = :groupID');

        $stmt4->bindParam(':groupID', $groupID);
        $stmt4->execute();

        echo "Group Deleted Successfully</br>";
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
