<html>
<head>
<title>Home Page</title>
</head>
<body>
<?php
    try{
        //Start session
        session_start();
        //Use session to grab variable from login page
        $userID = $_SESSION['userID'];
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);

        $stmt2 = $file_db->prepare('SELECT name
                                   FROM album
                                   WHERE albumID in
                                      (SELECT albumID
                                       FROM userPermissionsAlbum
                                       WHERE :userID = userID)');

        $stmt2->bindParam(':userID', $userID);
        $stmt2->execute();


        $stmt = $file_db->prepare('SELECT name      
                                 FROM photoGroup
                                 WHERE groupID in 
                                      (SELECT groupID
                                       FROM groupHasUser
                                       WHERE :userID = userID)');

        $stmt->bindParam(':userID', $userID);
        $stmt->execute();

    }

    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    
    $_SESSION['userID'] = $userID;

    if(!($userID)) {
            header("Location: login.html");
    }

    if(!$_SESSION['loggedin']){
            header("Location: login.html");
    };

?>
    <a href="managePhoto.php">Manage Photos</a>
    </br>
    </br>

    <form action="createAlbum.php" method="post">
    Create Album <br/>
    Album Name:<input name ="albumName" type ="text" />
    <input type="submit"/>
    </form>    

    <form action="manageAlbum.php" method="POST">
    Manage Album <br/>
    <select name="name" id="name">
<?php
    while($row = $stmt2->fetch()){
        $albumName = $row['name']; 
?>
    <option value="<?= $albumName; ?>"><?= $albumName; ?></option>
<?php
    }
    $file_db = null;
?>
    </select>
    <input type="submit">
    </form>

    <form action="createGroup.php" method="post">
    Create Group <br/>
    Group Name:<input name ="groupName" type ="text" />
    <input type="submit"/>
    </form>

    <form action="manageGroup.php" method="POST">
    Manage Group <br/>
    <select name="groupName" id="name">
<?php
    while($row = $stmt->fetch()){
        $groupName = $row['name']; 
?>
    <option value="<?= $groupName; ?>"><?= $groupName; ?></option>
<?php
    }
    $file_db = null;
?>
    </select>
    <input type="submit">
    </form>

    <a href="accountSettings.php">Account Settings</a>
    <br/>
    <br/>
    <a href="logout.php">Log Out</a>

</body>
</html>
