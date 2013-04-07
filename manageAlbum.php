<html>
<head>
<title>Manage Album</title>
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

   

        // Close file db connection
        $file_db = null;


        //Pass Variable to session
        $_SESSION['userID'] = $userID;

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };


        if(!($_SESSION['loggedin'])){
            header("Location: invalidLogin.html");
        }


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
