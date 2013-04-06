<html>
<head>
<title>Creating Account</title>
</head>
<body>
<?php

    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:photos');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                                PDO::ERRMODE_EXCEPTION);

        $userID = $_POST['userID'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $profilePicData = null;
        $gender = $_POST['gender'];
        $favoriteGenre = $_POST['favoriteGenre'];
        $country = $_POST['country']; 

        if(empty($userID) || empty($password) || empty($name) || empty($gender) || empty($favoriteGenre) || empty($country)){
            // Close file db connection
            $file_db = null;
            header("Location: createAccountInvalid.html");
        }
        else{

        $insert = "INSERT INTO user (userID, password, name, dateJoined, gender, profilePicData, favoriteGenre, country)
                    VALUES(:userID, :password, :name, datetime(), :gender, :profilePicData, :favoriteGenre, :country)";
        $stmt = $file_db->prepare($insert);

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':profilePicData', $profilePicData);
        $stmt->bindParam(':favoriteGenre', $favoriteGenre);
        $stmt->bindParam(':country', $country);

        $stmt->execute();

        // Close file db connection
        $file_db = null;
        echo "Account created sucessfully. <br />";
        }
    } 
    catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
    }
?>

<br/>
</body>
</html>
