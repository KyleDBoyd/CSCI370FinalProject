<html>
<head>
<title>Insert Photo</title>
</head>
<body>
<?php
    try {
        //Start session
        session_start();
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                 PDO::ERRMODE_EXCEPTION);
        //Use session to grab variable from login page
        $userID = $_SESSION['userID']; 

        if(!isset($userID)) {
                header("Location: login.html");
        }

        if(!$_SESSION['loggedin']){
                header("Location: login.html");
        };
    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
<form action="insertPhotoSQL.php" method="post" enctype="multipart/form-data">
Name:<input name="name" type="text" />
Genre:<input name="genre" type="text" />
Image:<input name="file" id="file" type="file" /> 
Location:<select name="type" id="type">
<?php
    $stmt = $file_db->prepare('SELECT type
                               FROM locations');     

    $stmt->execute();
    while($row = $stmt->fetch()){
        $type = $row['type'];  
?>
<option value="<?= $type; ?>"><?= $type; ?></option>
<?php
    }
?>
</select>
<input type="submit">
</form>
<br/>
<a href="createAccount.html">Back to Home Page</a>
</body>
</html>
