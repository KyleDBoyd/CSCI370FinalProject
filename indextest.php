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

        $stmt = $file_db->prepare('SELECT name      
                          FROM photoGroup
                          WHERE groupID in 
                               (SELECT groupID
                                FROM groupHasUser
                                WHERE :userID = userID)');

        $stmt->bindParam(':userID', $userID);
        $result = $stmt->execute();

        if(!$userID) {
            echo "Error";
        }

    }      
 
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    
    if(!$_SESSION['loggedin']){
            header("Location: login.html");
    };

?>
    <a href="InsertPhotoSQL.php">Manage Photos</a>
    </br>
    </br>

    <select name="name" id="name">
<?php
    foreach($result as $row) {
        $photoName = $row['name'];  
?>
    <option value="<?= $photoName; ?>"><?= $photoName; ?></option>
<?php
    }
    $file_db = null;
?>
    </select>
    <br/>
    <br/>
    <a href="logout.php">Log Out</a>

</body>
</html>
