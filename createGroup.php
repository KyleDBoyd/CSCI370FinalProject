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

        $userID = $_SESSION['userID'];
        $groupName = $_POST['groupName'];

        $stmt2 = $file_db->prepare('SELECT name
                                    FROM user
                                    WHERE :userID = userID');

        $stmt2->bindParam(':userID', $userID);
        $leader = $stmt2->execute();
  
        $stmt = $file_db->prepare('INSERT INTO photoGroup (name, leader)  
                                   VALUES(:groupName, :leader)');

        $stmt->bindParam(':leader', $leader);
        $stmt->bindParam(':groupName', $groupName);
        $stmt->execute();

        // Close file db connection
        $file_db = null;

        echo "Group created sucessfully. <br />";

        echo '<a href="index.php">Back to Home</a>';

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };

    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
</body>
</html>
