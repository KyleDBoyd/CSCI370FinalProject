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

            $html = '<select name="'.$name.'">';

            if($queryType == 1) {

                $insert = 'SELECT name 
                               FROM album
                               WHERE albumID in 
                                    (SELECT albumID
                                     FROM userCreateAlbum
                                     WHERE :userID = userID)
                               ORDER by dateCreated';
     
                $result = mysqli_query($file_db, $insert);
                $row = mysqli_fetch_array($result, MYSQLI_NUM);
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

                $result = mysqli_query($file_db, $insert);
                $row = mysqli_fetch_array($result, MYSQLI_NUM);
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
    <a href="InsertPhotoSQL.php">Manage Photos Page</a>

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

    <a href="AccountSettings.php">Account Settings</a>
   
    <br/>
    <a href="logout.php">Log Out</a>

</body>
</html>
