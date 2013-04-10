<html>
<head>
<title>Viewing Photos</title>
</head>
<body>
<?php

    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);
        //start session
        session_start();
        $albumName = $_SESSION['albumName']; 

        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };

        $stmt = $file_db->prepare('SELECT albumID
                                   FROM album
                                   WHERE name = :albumName');

        $stmt->bindParam(':albumName',$albumName);
        $stmt->execute();

        $row = $stmt->fetch();
        $albumID = $row['albumID'];      

        $query = "SELECT imgPath
                  FROM photo
                  WHERE photoID in
                      (SELECT photoID
                       FROM albumHasPhoto
                       WHERE albumID = :albumID)";

        $query = $file_db->prepare($query);
        $query->bindParam(':albumID', $albumID);
        $query->execute();  
        
        $i=0;
        while($row = $query->fetch()){
            $image = $row['imgPath'];
            echo "<img src=\"$image\" height=\"250px\" width=\"250px\">";
            $i++;
            if($i==4){
                echo "<br/>";
                $i=0;
            }
        }
    
        // Close file db connection
        $file_db = null;
    }
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
<br/>
<a href="index.php">Back to Home</a>
</body>
</html>
