<html>
<head>
<title>Account Settings</title>
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

        $stmt = $file_db->prepare('SELECT *     
                                    FROM photographer
                                    WHERE photographerID = :userID');

        $stmt->bindParam(':userID', $userID);
        $stmt->execute();

        if ($stmt->fetch()) {
        //They don't need photographer options

        } else {
?>
    <br/>
    Upgrade to Photographer:
    <br/>
    <form action="addPhotographer.php" method="POST">
    <input type="radio" name="photographerType" value="Professional"/> Professional
    <input type="radio" name="photographerType" value="Amateur"/> 
Amateur
    <input type="submit"/>
    </form>
    <br/>
<?php
        }
        // Close file db connection
        $file_db = null;
    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>        
<form action="changePasswordSQL.php" method="post">
Change Password
<br/>
Old Password:<input name="oldPassword" type="password" />
New Password:<input name="newPassword" type="password" />
<input type="submit"/>
</form>
<br/>
<a href="index.php">Home Page</a>
<br/>
<a href="logout.php">Log Out</a>
</body>
</html>
