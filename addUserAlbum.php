<html>
<head>
<title>Add Member</title>
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
        $memberID = $_POST['memberName'];
        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };

        if(!($userID)) {
            header("Location: login.html");
        }        

        $stmt = $file_db->prepare('SELECT *     
                                 FROM user
                                 WHERE userID = :memberID');

        $stmt->bindParam(':memberID', $memberID);
        $stmt->execute();

        //Check if member exists
        if($stmt->fetch()) {

            $stmt3 = $file_db->prepare('SELECT albumID      
                                     FROM album
                                     WHERE name = :albumName');

            $stmt3->bindParam(':albumName', $albumName);
            $stmt3->execute();
            $row = $stmt3->fetch();
            $albumID = $row['albumID'];

            $stmt2 = $file_db->prepare('INSERT INTO userHasAlbum (albumID, userID)  
                                       VALUES(:albumID, :memberID)');

            $stmt2->bindParam(':albumID', $albumID);
            $stmt2->bindParam(':memberID', $memberID);
            $stmt2->execute();
            
            // Close file db connection
            $file_db = null;
            echo "Member Added Successfully</br>";
            echo '</br><a href="index.php">Back to Home</a>';

        } else {
            // Close file db connection
            $file_db = null;
            echo "Member does not exist</br>";
            echo '</br><a href="index.php">Back to Home</a>';
        }
    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
?>
</body>
</html>
