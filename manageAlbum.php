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
        $albumName = $_POST['albumName'];
        $_SESSION['albumName'] = $albumName;
        $userID = $_SESSION['userID'];

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
<br/>
<form action="addPhotoAlbum.php" method="post">
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
<br/>
Select Photo to Delete <br/>
<form action="deletePhotoAlbum.php" method="post">
<select name="name" id="name">
<?php
$stmt = $file_db->prepare('SELECT name      
                             FROM photo
                             WHERE photoID in 
                                  (SELECT photoID
                                   FROM albumHasPhoto
                                   WHERE albumID in
                                       (SELECT albumID
                                        FROM album
                                        WHERE :albumName = name))');
$stmt->bindParam(':albumName', $albumName);
    $stmt->execute();
    while($row = $stmt->fetch()){
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
</br>
<a href="viewAlbumPhoto.php">View Albums photos</a><br/>
<a href="deleteAlbum.php">Delete Album</a><br/>
<br/>
<a href="index.php">Back to Home</a>
</body>
</html>
