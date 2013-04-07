<html>
<head>
<title>Deleting Photo</title>
</head>
<body>
<?php

    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name'];

        $delete = "DELETE FROM photo WHERE name = :name";

        $stmt = $file_db->prepare($delete);

        $stmt->bindParam(':name', $name);
        $stmt->execute();

        // Close file db connection
        $file_db = null;
        echo "Picture Deleted sucessfully. <br />";
        
    } 
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
<a href="index.html">Back to Home</a>
<br/>
</body>
</html>
