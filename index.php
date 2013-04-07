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

    function generateSelect($userID = ' ', $name = ' ', $queryType = ' ') {

        $html = '<selectname="'.$name.'">';

        if($queryType == 1) {

            foreach ($options as $option => $value) {

                $insert = 'SELECT name 
                           FROM album
                           WHERE albumID in 
                                (SELECT albumID
                                 FROM userCreateAlbum
                                 WHERE userID = :userID)');             

                $stmt = $file_db->prepare($insert);
                $stmt->bindParam(':userID', $userID);
                $stmt->execute();

                $html .= '<option value=' .$value.'>'.$stmt.'</option>';

            }
        } elseif($queryType == 2) {

            foreach ($options as $option => $value) {

                $insert = 'SELECT name                                     
                           FROM photoGroup
                           WHERE groupID in 
                                (SELECT groupID
                                 FROM groupHasUser
                                 WHERE :userID = userID)');             

                $stmt = $file_db->prepare($insert);
                $stmt->bindParam(':userID', $userID);
                $stmt->execute();

                $html .= '<option value=' .$value.'>'.$stmt.'</option>';
            }
        }
        
        $html .= '</select>';
        return $html;
    }

//NOT WORKING
    //catch(PDOException $e) {
    // Print PDOException message
    //echo $e->getMessage();
    //}
    
    if(!$_SESSION['loggedin']){
            header("Location: login.html");
    };
?>
    <a href="InsertPhotoSQL.php">Manage Photos Page</a>

    <form action="ManageAlbum.php" method="post">
        Album Name
<?php
        $html = generateSelect($userID, 'Albums', 1);
?>
        <input type="submit"/>
    </form>

    <form action="ManageGroup.php" method="post">
        Group Name
<?php
        $html = generateSelect($userID, 'Groups', 2);
?>     
    <input type="submit"/>
    </form>

    <a href="AccountSettings.php">Account Settings</a>
   
    <br/>
    <a href="logout.php">Log Out</a>

</body>
</html>
