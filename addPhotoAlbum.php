<html>
<head>
<title>Adding photo to Album</title>
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

        $albumName = $_SESSION['albumName'];
        $photoName = $_POST['name'];
        $userID = $_SESSION['userID'];

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

        // get albumID
        $stmt = $file_db->prepare('SELECT albumID
                                   FROM album
                                   WHERE name = :albumName');

        $stmt->bindParam(':albumName',$albumName);
        $stmt->execute();

        $row = $stmt->fetch();
        $albumID = $row['albumID'];    

        $stmt = $file_db->prepare('INSERT INTO albumHasPhoto (albumID, photoID)  
                                       VALUES(:albumID, :photoID)');

        $stmt->bindParam(':albumID', $albumID);
        $stmt->bindParam(':photoID', $photoID);
        $stmt->execute();


        echo "Photo added sucessfully</br>";
        echo '</br><a href="index.php">Back to Home</a>';

        // Close file db connection
        $file_db = null;        
    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
?>

</body>
</html>
