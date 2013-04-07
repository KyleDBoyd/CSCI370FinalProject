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

        $genre = $_POST['genre'];
        $name = $_POST['name'];
        
        // need to add extra error checks

            if ($_FILES["file"]["error"] > 0){
                $file_db = null;
                header("Location: insertPhotoError.html");
            }else{
                $imgName = $_FILES["file"]["name"];
                $imgType = $_FILES["file"]["type"];
                $imgSize = ($_FILES["file"]["size"] / 1024);
                $imgPath = "images/" . $imgName;
                // move image into folder
                move_uploaded_file($_FILES["file"]["tmp_name"], $imgPath);
            }
            
        $insert = "INSERT INTO photo (genre, name, date, imgName, imgType, imgPath, imgSize)
                    VALUES(:genre, :name, datetime(), :imgName, :imgType, :imgPath, :imgSize)";

        $stmt = $file_db->prepare($insert);
        
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':imgName', $imgName);
        $stmt->bindParam(':imgType', $imgType);
        $stmt->bindParam(':imgPath', $imgPath);
        $stmt->bindParam(':imgSize', $imgSize);

        $stmt->execute();

        // Need to insert into userHasPhoto and userPermissionsPhoto

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
