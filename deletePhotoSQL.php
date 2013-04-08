<html>
<head>
<title>Deleting Photo</title>
</head>
<body>
<?php

    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name'];
        $userID = $_SESSION['userID'];

        // get photoID
        $query = "SELECT photoID FROM photo WHERE imgName = :imgName";
        $query = $file_db->prepare($query);
        $query->bindParam(':Name', $Name);
        $photoID = $query->execute();        

        // Insert into userHasPhoto
        $delete = "DELETE FROM userHasPhoto WHERE userID = :userID AND photoID = :photoID";
    
        $stmt = $file_db->prepare($insert);

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':photoID', $photoID);

        $stmt->execute();

        // Insert into userPermissionsPhoto
        $delete = "DELETE FROM userPermissionsPhoto WHERE userID = :userID AND photoID = :photoID";
    
        $stmt = $file_db->prepare($delete);

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':photoID', $photoID);

        $stmt->execute();

        // delete photo
        $delete = "DELETE FROM photo WHERE name = :name";
        $stmt = $file_db->prepare($delete);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        // Close file db connection
        $file_db = null;
        echo "Picture Deleted sucessfully. <br />";
        
    } 
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
<a href="index.html">Back to Home</a>
<br/>
</body>
</html>
