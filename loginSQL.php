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
             // Close file db connection
             $file_db = null;
	         header("Location: index.html");
        }
        // Close file db connection
        $file_db = null;

<<<<<<< HEAD

=======
>>>>>>> 04e39a755c18c5e0e7182385bee50ecec9cdc269
        //Pass Variable to session
        $_SESSION['userID'] = $userID;

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
<<<<<<< HEAD

        if(!($_SESSION['loggedin'])){
            header("Location: invalidLogin.html");
        }

=======
        if(!($_SESSION['loggedin'])){
            header("Location: invalidLogin.html");
        }
>>>>>>> 04e39a755c18c5e0e7182385bee50ecec9cdc269
    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
</body>
</html>
