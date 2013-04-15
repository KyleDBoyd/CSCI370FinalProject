<html>
<head>
<title>Manage Location</title>
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

        if(!isset($userID)) {
            header("Location: login.html");
        }

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };

        $file_db = null;

    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }

?>
<form action="addLocation.php" method="post">
Add Location <br/> <br/>
Location Type:<input name ="locationType" type ="text" />
<br/>
Address:<input name ="Address" type ="text" />
<br/>
Country:<input name ="Country" type ="text" />
<input type="submit"/>
</form>
<br/>
<br/>
<a href="index.php">Back to Home</a>
</body>
</html>
