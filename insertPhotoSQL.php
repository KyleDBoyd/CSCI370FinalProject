<html>
<head>
<title>Inserting Photo</title>
</head>
<body>
<?php

    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);

        session_start();
        $userID = $_SESSION['userID']; 

        if(!($userID)) {
            header("Location: login.html");
        }

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
        $genre = $_POST['genre'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        

            if ($_FILES["file"]["error"] > 0){
                $file_db = null;
                echo "Error in file";
                exit();
            }else{
                $imgPath = "images/" . $name . $userID;
                // move image into folder
                move_uploaded_file($_FILES["file"]["tmp_name"], $imgPath);
            }
        // Insert into photos table
        $insert = "INSERT INTO photo (name, genre, date, imgPath)
                    VALUES(:name, :genre, datetime(), :imgPath)";

        $stmt = $file_db->prepare($insert);
        
        $stmt->bindParam(':name', $genre);
        $stmt->bindParam(':genre', $name);
        $stmt->bindParam(':imgPath', $imgPath);

        $stmt->execute();
        
        // Select photoID from photo that was inserted    
        $photoID = $file_db->lastInsertId();

        // Insert into userHasPhoto
        $insert = "INSERT INTO userHasPhoto (userID, photoID)
                   VALUES(:userID, :photoID)";
    
        $stmt = $file_db->prepare($insert);

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':photoID', $photoID);

        $stmt->execute();
    
        // get locationID
        $stmt = $file_db->prepare('SELECT locationID
                                   FROM location
                                   WHERE type = :type');

        $stmt->bindParam(':type',$type);
        $stmt->execute();

        $row = $stmt->fetch();
        $locationID = $row['locationID'];  

        $insert = "INSERT INTO photoTakenAtLocation (photoID, locationID)
                   VALUES(:photoID, :locationID)";
    
        $stmt = $file_db->prepare($insert);

        $stmt->bindParam(':photoID', $photoID);
        $stmt->bindParam(':locationID', $locationID);

        $stmt->execute();        

        echo "Image inserted sucessfully <br/>";

        // Close file db connection
        $file_db = null;
    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
<a href="index.php">Back to Home</a>
</body>
</html>
