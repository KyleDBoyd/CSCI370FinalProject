<html>
<head>
<title>Add Member</title>
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

        $groupName = $_SESSION['groupName'];
        $memberID = $_POST['memberName'];

        $stmt = $file_db->prepare('SELECT *     
                                 FROM user
                                 WHERE name = :memberID');

        $stmt->bindParam(':memberID', $memberID);
        $stmt->execute();

        //Check if member exists
        if($stmt->fetch()) {

            $stmt3 = $file_db->prepare('SELECT groupID      
                                     FROM photoGroup
                                     WHERE name = :groupName');

            $stmt3->bindParam(':groupName', $groupName);
            $stmt3->execute();
            $row = $stmt3->fetch();
            $groupID = $row['groupID'];

            $stmt2 = $file_db->prepare('INSERT INTO groupHasUser (groupID, userID)  
                                       VALUES(:groupID, :memberID)');

            $stmt2->bindParam(':groupID', $groupID);
            $stmt2->bindParam(':memberID', $memberID);
            $stmt2->execute();

            echo "Member Added Successfully</br>";
            echo '</br><a href="index.php">Back to Home</a>';

        } else {

            echo "Member does not exist</br>";
            echo '</br><a href="index.php">Back to Home</a>';

            // Close file db connection
            $file_db = null;

            if(!$_SESSION['loggedin']){
                header("Location: login.html");
            };

            if(!($userID)) {
                header("Location: login.html");
            }
        }

    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
?>

</body>
</html>
