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

    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>
<select name="name" id="name">
<?php
    $stmt = $file_db->prepare('SELECT name      
                             FROM photo
                             WHERE photoID in 
                                  (SELECT photoID
                                   FROM userHasPhoto
                                   WHERE :userID = userID)');

    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    while($row = $stmt->fetch()){
        $photoName = $row['name'];  
?>
<option value="<?= $photoName; ?>"><?= $photoName; ?></option>
<?php
    }
?>
</select>
<input type="submit">
</form>
<a href="index.php">Back to Home</a>
</body>
</html>
