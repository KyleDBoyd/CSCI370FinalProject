<html>
<head>
<title>Inserting Photo</title>
</head>
<body>
<?php

    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);

        $genre = $_POST['genre'];
        $name = $_POST['name'];
        $imgType = $_POST['imgType'];
        $imgData = $_POST['imgData'];  

        $insert = "INSERT INTO photo (genre, name, date, imgType, imgData)
                    VALUES (:genre, :name, datetime(), :imgType, :imgData)";
        $stmt = $file_db->prepare($insert);

        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':imgType', $imgType);
        $stmt->bindParam(':imgData', $imgData);

        $stmt->execute();

        // Close file db connection
        $file_db = null;
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
<a href="index.php">Back to Home</a>
</body>
</html>
