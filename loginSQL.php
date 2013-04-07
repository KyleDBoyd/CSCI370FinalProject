<html>
<head>
<title>Inserting Photo</title>
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

        $userID = $_POST['userID'];
        $password = $_POST['password'];
  
        $stmt = $file_db->prepare('SELECT *                                     
                                   FROM user
                                   WHERE :userID = userID 
                                   AND :password = password');

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        if ($stmt->fetch()) { 
	        $_SESSION['loggedin'] = true;
            //Pass Variable to session
            $_SESSION['userID'] = $userID;
            // Close file db connection
            $file_db = null;
	        header("Location: index.php");
        }
        // Close file db connection
        $file_db = null;

        if(!($_SESSION['loggedin'])){
            header("Location: invalidLogin.html");
        }

    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
</body>
</html>
