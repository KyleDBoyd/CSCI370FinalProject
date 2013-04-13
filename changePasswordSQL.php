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
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
    
        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };
  
        $stmt = $file_db->prepare('UPDATE user                        
                                   SET password = :newPassword
                                   WHERE :userID = userID 
                                   AND :oldPassword = password');

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':oldPassword', $oldPassword);
        $stmt->bindParam(':newPassword', $newPassword);
        $stmt->execute();

        // Close file db connection
        $file_db = null;

    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
    header("Location: accountSettings.php");
?>
