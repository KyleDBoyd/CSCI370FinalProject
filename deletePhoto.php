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
        if(!$_SESSION['loggedin']){
            header("Location: login.html");
         };
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);

        echo "Select photo to delete from database. <br/>";

        
        $stmt = $file_db->prepare('SELECT name FROM photo');
        $result = $stmt->execute();
    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>
<select name="name" id="name">
<?php
    while($row = $result->fetchArray()){
        $photoName = $row["name"];
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
