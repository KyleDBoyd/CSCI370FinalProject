<html>
<head>
<title>Create Group</title>
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

        $userID = $_SESSION['userID'];

        $groupName = $_POST['groupName'];

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
  
        $stmt = $file_db->prepare('INSERT INTO photoGroup (name, leader, size)  
                                   VALUES(:groupName, :leader, 0)');

        $stmt->bindParam(':leader', $userID);
        $stmt->bindParam(':groupName', $groupName);
        $stmt->execute();

        //Grab groupID from last insert
        $groupID = $file_db->lastinsertID();

        $stmt2 = $file_db->prepare('INSERT INTO groupHasUser (groupID, userID)
                                   VALUES(:groupID, :userID)');

        $stmt2->bindParam(':groupID', $groupID);
        $stmt2->bindParam(':userID', $userID);
        $stmt2->execute();

        // Close file db connection
        $file_db = null;

        echo "Group created sucessfully. <br />";

        echo '<a href="index.php">Back to Home</a>';
    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }

    $_SESSION['userID'] = $userID;

    if(!($userID)) {
            header("Location: login.html");
    }
?>
</body>
</html>
