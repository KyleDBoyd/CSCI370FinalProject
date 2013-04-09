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
        //Get current user's ID
        $userID = $_SESSION['userID'];

        $albumName = $_POST['albumName'];
        $_SESSION['albumName'] = $albumName;

        // Close file db connection
        $file_db = null;

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };

    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
<form action="addUserAlbum.php" method="post">
    Add Member <br/>
    Member's Username:<input name ="memberName" type ="text" />
    <input type="submit"/>
</form>

<a href="deleteAlbum.php">Delete Album</a>
<br/>
<br/>
<a href="index.php">Back to Home</a>

</body>
</html>
