<html>
<head>
<title>Delete Group</title>
</head>
<body>
<?php

    //Start session
    session_start();
    try {
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);
        //album and photo name
        $albumName = $_SESSION['albumName'];
        $photoName = $_POST['name'];

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
        
        // Get photoID
        $stmt = $file_db->prepare('SELECT photoID
                                   FROM photo
                                   WHERE name = :photoName');

        $stmt->bindParam(':photoName',$photoName);
        $stmt->execute();

        $row = $stmt->fetch();
        $photoID = $row['photoID']; 

        //Delete Group from relations

        $stmt = $file_db->prepare('DELETE
                                    FROM albumHasPhoto
                                    WHERE photoID = :photoID'); 
        
        $stmt->bindParam(':photoID', $photoID);
        $stmt->execute();

        echo "Photo Deleted Sucessfully</br>";
        echo '</br><a href="index.php">Back to Home</a>';

        $file_db = null;
        
    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
?>

</body>
</html>
