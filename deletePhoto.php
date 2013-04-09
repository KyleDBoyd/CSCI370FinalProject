<html>
<head>
<title>Delete Photo</title>
</head>
<body>
<form action="deletePhotoSQL.php" method="post">
<?php
    
    try{
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
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);
   
        $result = $file_db->query('SELECT name FROM photo');
    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>
<select name="name" id="name">
<?php
    foreach($result as $row){
        $photoName = $row['name'];  
?>
<option value="<?= $photoName; ?>"><?= $photoName; ?></option>
<?php
    }
    $file_db = null;
?>
</select>
<input type="submit">
</form>
<a href="index.php">Back to Home</a>
</body>
</html>
