html>
<head>
<title>Inserting User</title>
</head>
<body>
<?php

    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);

        $userId = $_POST['userID'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $dateJoined = $_POST['dateJoined'];
        $gender = $_POST['gender'];
        $profilePicData = $_POST['profilePicData'];  
        $favoritePhotoType = $_POST['favoritePhotoType'];
        $favoriteGenre = $_POST['favoriteGenre'];
        $country = $_POST['country'];

        $insert = "INSERT INTO user (userID, password, name, dateJoined, gender,
                                     profilePicData, favoritePhotoType, favoriteGenre, country)
                    VALUES (:userID, :password, :name, :dateJoined, :gender,
                                     :profilePicData, :favoritePhotoType, :favoriteGenre, :country)";

        $stmt = $file_db->prepare($insert);

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':dateJoined', $dateJoined);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':profilePicData', $profilePicData);
        $stmt->bindParam(':favoritePhotoType', $favoritePhotoType);
        $stmt->bindParam(':favoriteGenre', $favoriteGenre);
        $stmt->bindParam('country', $country);

        $stmt->execute();

    // Close file db connection
    $file_db = null;

    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>
</body>
</html>
