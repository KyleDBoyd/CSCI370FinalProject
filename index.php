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

        function generateSelect($userID, $name, $queryType) {

            // Create (connect to) SQLite database in file
            $file_db = new PDO('sqlite:photos');

            $html = '<select name="'.$name.'">';

            if($queryType == 1) {

                $insert = 'SELECT name 
                               FROM album
                               WHERE albumID in 
                                    (SELECT albumID
                                     FROM userCreateAlbum
                                     WHERE :userID = userID)
                               ORDER by dateCreated';
     
                $stmt = $file_db->prepare($insert);
                $stmt->bindParam(':userID', $userID);
                $stmt->execute(array(1));
                $row = $stmt->fetch();
                $i = 0;

                while($row[$i]) {            

                    $html .= '<option value=' .$value.'>'.$row[$i].'</option>';
                    $i++;
                }

            } elseif($queryType == 2) {

                    $insert = 'SELECT name                                    
                               FROM photoGroup
                               WHERE groupID in 
                                    (SELECT groupID
                                     FROM groupHasUser
                                     WHERE :userID = userID)';             

                $stmt = $file_db->prepare($insert);
                $stmt->bindParam(':userID', $userID);
                $stmt->execute(array(1));
                $row = $stmt->fetch();
                $i = 0;

                while($row[$i]) {            

                    $html .= '<option value=' .$value.'>'.$row.'</option>';
                    $i++;
                }
            }
            
            $html .= '</select>';
            return $html;
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
    <form action="ManageAlbum.php" method="post">
        Album Name
<?php
        try {        
        $html = generateSelect($userID, 'Albums', 1);
        echo $html;
        }

        catch(PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }
?>
        <input type="submit"/>
    </form>

    <form action="ManageGroup.php" method="post">
        Group Name
<?php
        try{
            $html = generateSelect($userID, 'Groups', 2);
            echo $html;

            $file_db = NULL;
        }

        catch(PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
        }

?>

    <input type="submit"/>
    </form>

    <a href="accountSettings.php">Account Settings</a>
    <br/>
    <br/>
    <a href="logout.php">Log Out</a>

</body>
</html>
