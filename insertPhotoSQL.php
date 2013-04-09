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
        
        // need to add extra error checks

            if ($_FILES["file"]["error"] > 0){
                $file_db = null;
                header("Location: insertPhotoError.html");
            }else{
                $imgPath = "images/" . $name;
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

        // Insert into userPermissionsPhoto
        $insert = "INSERT INTO userPermissionsPhoto (userID, photoID)
                   VALUES(:userID, :photoID)";
    
        $stmt = $file_db->prepare($insert);

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':photoID', $photoID);

        $stmt->execute();
    
       /* $query = $file_db->query('SELECT imgPath FROM photo');
        foreach($query as $row){
            $image = $row['imgPath'];
            echo "<img src=\"$image\">";
        }
      */
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
