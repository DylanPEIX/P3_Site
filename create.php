<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    if (!empty($_POST)) {
        include('includes/connect.php');
        $conn = connect();

        $requete = $conn->prepare("INSERT INTO player (firstname, pseudo, lastname, dob, country, game, team, text) VALUES (:firstname, :pseudo, :lastname, :dob, :country, :game, :team, :text);");

        // Retrieve form data
        $firstname = $_POST['firstname'];
        $pseudo = $_POST['pseudo'];
        $lastname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $country = $_POST['country'];
        $game = $_POST['game'];
        $team = $_POST['team'];
        $text = $_POST['text'];

        $requete->bindParam(':firstname', $firstname);
        $requete->bindParam(':pseudo', $pseudo);
        $requete->bindParam(':lastname', $lastname);
        $requete->bindParam(':dob', $dob);
        $requete->bindParam(':country', $country);
        $requete->bindParam(':game', $game);
        $requete->bindParam(':team', $team);
        $requete->bindParam(':text', $text);

        $result = $requete->execute();

        if ($result) {
            // If the insertion is successful, handle file upload
            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];

                // Move the uploaded file to the desired location with the new filename
                $lastInsertId = $conn->lastInsertId(); // Retrieve the last inserted ID
                $newFileName = 'img_' . $lastInsertId . '.png';
                move_uploaded_file($tmpName, 'assets/img/' . $newFileName);
            }
            echo "Data has been inserted successfully.";
        } else {
            echo "Error during data insertion.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create a new player</title>
    <link rel="stylesheet" href="CRUD/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Create a new player</h2>
        <form action="create.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" id="firstname" name="firstname" placeholder="Enter player first name">
            </div>
            <div class="input-group">
                <input type="text" id="lastname" name="lastname" placeholder="Enter player last name">
            </div>
            <div class="input-group">
                <input type="text" id="pseudo" name="pseudo" placeholder="Enter player pseudo">
            </div>
            <div class="input-group">
                <input type="date" id="dob" name="dob" placeholder="Enter player date of birth">
            </div>
            <div class="input-group">
                <input type="text" id="country" name="country" placeholder="Enter player country">
            </div>
            <div class="input-group">
                <input type="text" id="game" name="game" placeholder="Enter player game">
            </div>
            <div class="input-group">
                <input type="text" id="team" name="team" placeholder="Enter player team">
            </div>
            <div class="input-group">
                <textarea id="text" name="text" placeholder="Enter player description"></textarea>
            </div>
            <div class="input-group">
                <input type="file" id="file" name="file" accept="image/png, image/jpeg">
            </div>
            <button type="submit">Create player</button>
        </form>
    </div>
</body>
</html>
