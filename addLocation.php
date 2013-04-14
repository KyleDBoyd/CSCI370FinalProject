<html>
<head>
<title>Add Location</title>
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
        $locationType = $_POST['locationType'];
        $Address = $_POST['Address'];
        $Country = $_POST['Country'];

 
        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };

        if(!($userID)) {
            header("Location: login.html");
        }
    
        if(!$locationType) {
            echo 'Error: Location Type may not be NULL. <br/>';
        } else {

  
            $stmt = $file_db->prepare('INSERT INTO location (type, address, country)  
                                       VALUES(:locationType, :Address, :Country)');

            $stmt->bindParam(':locationType', $locationType);
            $stmt->bindParam(':Address', $Address);
            $stmt->bindParam(':Country', $Country);
            $stmt->execute();


            echo "Location added sucessfully. <br/>";
        }

        // Close file db connection
            $file_db = null;

        echo '<a href="index.php">Back to Home</a>';

    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }

?>
</body>
</html>
