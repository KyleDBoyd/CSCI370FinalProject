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

        session_start();
        //Use session to grab variable from login page
        $userID = $_SESSION['userID']; 

        if(!($userID)) {
            header("Location: login.html");
        }

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
        $name = $_POST['name'];

        // get photoID
        $query = "SELECT photoID FROM photo WHERE name = :name";
        $query = $file_db->prepare($query);
        $query->bindParam(':name', $name);
        $query->execute();  
        while($row = $query->fetch()){
            $photoID = $row['photoID'];
        }
            
        // Insert into userHasPhoto
        $delete = "DELETE FROM userHasPhoto WHERE userID = :userID AND photoID = :photoID";
    
        $stmt = $file_db->prepare($delete);

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
<a href="index.php">Back to Home</a>
<br/>
</body>
</html>
