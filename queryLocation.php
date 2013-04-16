<html>
<head>
<title>Popular Locations</title>
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
 
        if(!$_SESSION['loggedin']){
            header("Location: login.html");
        };

        if(!($userID)) {
            header("Location: login.html");
        }
    
        $query = "SELECT type, COUNT(*) as typeCount
                FROM location
                JOIN (
                    SELECT * FROM photoTakenAtLocation JOIN AlbumHasPhoto USING (photoID)
                ) USING (locationID)
                GROUP BY type
                ORDER BY typeCount DESC";

        $stmt = $file_db->prepare($query);

        $stmt->execute();
        
        echo 'Popular Locations <br/><br/>';

        while ($row = $stmt->fetch()) {
                $type = $row['type'];
                $occurence = $row['typeCount'];
                echo 'Location: ';
                echo $type; 
                echo ' has ';
                echo $occurence;
                echo ' occurences.<br/>';
        }
        echo '<br/>';

        // Close file db connection
            $file_db = null;

        echo '<a href="index.php">Back to Home</a>';

    }
    catch(PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }

?>
</body>
</html>
