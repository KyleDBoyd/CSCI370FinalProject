<html>
<head>
<title>Manage Group</title>
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
        //Get current user's ID
        $userID = $_SESSION['userID'];
        $groupName = $_POST['groupName'];
        $_SESSION['groupName'] = $groupName;

        if(!($userID)) {
            header("Location: login.html");
        }   
        
        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };

        $stmt = $file_db->prepare('SELECT leader      
                                 FROM photoGroup
                                 WHERE name = :groupName');

        $stmt->bindParam(':groupName', $groupName);
        $stmt->execute();
        $row = $stmt->fetch();
        $leader = $row['leader'];

        $stmt2 = $file_db->prepare('SELECT name      
                                 FROM photoGroup
                                 WHERE groupID in 
                                      (SELECT groupID
                                       FROM groupHasUser
                                       WHERE :userID = userID)');

        $stmt2->bindParam(':userID', $userID);
        $stmt2->execute();

    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
        if($userID == $leader) {
            //Leader functionalities
?>
<p>Leader Page</p>
</br>
<a href="deleteGroup.php">Delete Group</a><br/>

<form action="addUserGroup.php" method="post">
    Add Member <br/>
    Member's Username:<input name ="memberName" type ="text" />
    <input type="submit"/>
</form>

<form action="addPhotoGroup.php" method="post">
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
<form action="deletePhotoGroup.php" method="post">
<select name="name" id="name">
<?php
    $stmt = $file_db->prepare('SELECT name
                               FROM photo
                               WHERE photoID in
                                   (SELECT photoID
                                    FROM grouphasPermissionPhoto
                                    where groupID in
                                        (SELECT groupID
                                         FROM photoGroup
                                         WHERE :groupName = name))');

    $stmt->bindParam(':groupName', $groupName);
    $stmt->execute();
    while($row = $stmt->fetch()){
        $photoName = $row['name'];
?>
<option value="<?= $photoName; ?>"><?= $photoName; ?></option>
<?php
    }
?>

<?php
    } else {
        //Member functionalities
        echo "Member Page</br>";
    }
    
    echo "Select Album to view Photo";
    $stmt = $file_db->prepare('SELECT name      
                             FROM album
                             WHERE albumID in 
                                  (SELECT albumID
                                   FROM groupHasPermissionAlbum
                                   WHERE :groupID = groupID)');

    $stmt->bindParam(':groupID', $groupID);
    $stmt->execute();
?>
<form action="viewGroupAlbumPhoto.php" method="post">
<select name="albumName" id="albumName">
<?php
    while($row = $stmt->fetch()){
    $albumName = $row['name'];  
?>
<option value="<?= $albumName; ?>"><?= $albumName; ?></option>
<?php
    }
    $file_db = null;
?>
</select>
<input type="submit"/>
</form>
<br/>
<a href="viewGroupPhoto.php">View Groups Photos</a><br/>
<br/>
<a href="index.php">Back to Home</a><br/>

</body>
</html>
