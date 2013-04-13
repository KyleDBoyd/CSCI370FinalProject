<html>
<head>
<title>Insert Photo</title>
</head>
<body>
<?php
    //Start session
    session_start();
    //Use session to grab variable from login page
    $userID = $_SESSION['userID']; 

    if(!isset($userID)) {
            header("Location: login.html");
    }

    if(!$_SESSION['loggedin']){
            header("Location: login.html");
    };
?>
	<form action="insertPhotoSQL.php" method="post" enctype="multipart/form-data">
        Name:<input name="name" type="text" />
        Genre:<input name="genre" type="text" />
        Image:<input name="file" id="file" type="file" />
        <input type="submit"/>
    </form>
    <br/>
    <a href="createAccount.html">Back to Home Page</a>
</body>
</html>
