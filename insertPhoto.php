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
?>
	<form action="insertPhotoSQL.php" method="post" enctype="multipart/form-data">
        Genre:<input name="genre" type="text" />
        Name:<input name="name" type="text" />
        Image:<input name="file" id="file" type="file" />
        <input type="submit"/>
    </form>
    <br/>
    <a href="createAccount.html">Back to Home Page</a>
</body>
</html>
