<html>
<head>
<title>Manage Photos</title>
</head>
<body>
<?php
    //Start session
    session_start();
    //Use session to grab variable from login page
    $userID = $_SESSION['userID']; 

    if(!($userID)) {
            header("Location: login.html");
    }

    if(!$_SESSION['loggedin']){
            header("Location: login.html");
    };
?>
	<a href="insertPhoto.php">Insert Photo</a><br/>
    <a href="deletePhoto.php">Delete Photo</a><br/>
    <a href="viewPhoto.php">View Photos</a><br/>
</body>
</html>
