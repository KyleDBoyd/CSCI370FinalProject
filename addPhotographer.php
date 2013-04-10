<html>
<head>
<title>Upgrade to Photographer</title>
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
        $level = $_POST['photographerType'];


        $stmt = $file_db->prepare('INSERT INTO photographer (photographerID, level)  
                                   VALUES(:userID, :level)');

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':level', $level);
        $stmt->execute();

        echo "Upgraded to Photographer Successfully</br>";
        echo '</br><a href="accountSettings.php">Back to Account Settings</a>';
        echo '</br><a href="index.php">Back to Home</a>';

       
        // Close file db connection
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
