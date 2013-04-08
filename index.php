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
        // This doesnt work
        if(!($userID)) {
            header("Location: login.html");
        }
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
        $groupResult = $stmt->execute();
    }

    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    
    if(!$_SESSION['loggedin']){
            header("Location: login.html");
    };

?>
    <a href="managePhoto.php">Manage Photos</a>
    </br>
    </br>

    
    <form action="createGroup.php" method="post">
    Create Group <br/>
    Group Name:<input name ="groupName" type ="text" />
    <input type="submit"/>
    </form>

    <form action="manageGroup.sql" method="POST">
    <select name="name" id="name">
<?php
    foreach($groupResult as $row){
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
