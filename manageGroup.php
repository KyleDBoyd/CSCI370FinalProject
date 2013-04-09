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

        if($userID == $leader) {
            //Leader functionalities
?>
Leader Page
</br>
</br>
<form action="deleteGroup.php" method="POST">
    Delete Group <br/>
    <select name="groupName" id="name">
<?php
    while($row = $stmt2->fetch()){
        $groupName2 = $row['name']; 
?>
    <option value="<?= $groupName2; ?>"><?= $groupName2; ?></option>
<?php
    }
    $file_db = null;
?>
    </select>
    <input type="submit">
    </form>

    <form action="addUserGroup.php" method="post">
    Add Member <br/>
    Member's Username:<input name ="memberName" type ="text" />
    <input type="submit"/>
    </form>    


    </br>
    <a href="index.php">Back to Home</a>
<?php
        } else {
            //Member functionalities
            echo "Member Page</br>";
            echo '</br><a href="index.php">Back to Home</a>';
        }

        // Close file db connection
        $file_db = null;

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
        
        $_SESSION['userID'] = $userID;
        $_POST['groupName'] = $groupName;

        if(!($userID)) {
            header("Location: login.html");
        }

    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
?>

</body>
</html>
