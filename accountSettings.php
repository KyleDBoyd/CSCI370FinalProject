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


        // Close file db connection
        $file_db = null;


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

    
    <form action="changePasswordSQL.php" method="post">
        Change Password
        <br/>
        <br/>
        Old Password:<input name="oldPassword" type="password" />
        New Password:<input name="newPassword" type="password" />
        <input type="submit"/>
    </form>
    <a href="changeProfilePicSQL.php">Change Profile Picture</a>
    <br/>
    <br/>
    <a href="index.php">Home Page</a>
    <br/>
    <a href="logout.php">Log Out</a>

</body>
</html>
