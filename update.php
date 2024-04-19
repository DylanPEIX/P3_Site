<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'includes/connect.php';
$conn = connect();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM player WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Utilisateur non trouvé.";
        exit();
    }
} else {
    echo "ID de l'utilisateur non spécifié ou invalide.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'identifiant du joueur est défini et est numérique
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Récupérer les données du formulaire
        $newFirstname = $_POST['firstname'];
        $newLastname = $_POST['lastname'];
        $newPseudo = $_POST['pseudo'];
        $newDob = $_POST['dob'];
        $newCountry = $_POST['country'];
        $newGame = $_POST['game'];
        $newTeam = $_POST['team'];
        $newText = $_POST['text'];

        // Préparer la requête de mise à jour
        $stmt = $conn->prepare("UPDATE player SET firstname = :firstname, lastname = :lastname, pseudo = :pseudo, dob = :dob, country = :country, game = :game, team = :team, text = :text WHERE id = :id");
        $stmt->bindParam(':firstname', $newFirstname);
        $stmt->bindParam(':lastname', $newLastname);
        $stmt->bindParam(':pseudo', $newPseudo);
        $stmt->bindParam(':dob', $newDob);
        $stmt->bindParam(':country', $newCountry);
        $stmt->bindParam(':game', $newGame);
        $stmt->bindParam(':team', $newTeam);
        $stmt->bindParam(':text', $newText);
        $stmt->bindParam(':id', $id);

        $result = $stmt->execute();

        if ($result) {
            // If the insertion is successful, handle file upload
            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];

                // Move the uploaded file to the desired location with the new filename
                $lastInsertId = $conn->lastInsertId(); // Retrieve the last inserted ID
                $newFileName = 'img_' . $id . '.png';
                move_uploaded_file($tmpName, 'assets/img/' . $newFileName);
            }
            echo "Data has been inserted successfully.";
        } else {
            echo "Error during data insertion.";
        }

        // Exécuter la requête de mise à jour
        if ($stmt->execute()) {
            echo "Joueur mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du joueur: " . $stmt->errorInfo();
        }

        // Récupérer à nouveau les données mises à jour de la base de données
        $stmt = $conn->prepare("SELECT * FROM player WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "ID du joueur introuvable, non spécifié ou invalide.";
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un joueur</title>
    <link rel="stylesheet" href="CRUD/style.css">
</head>
<body>

<div class="login-container">
    <h1>Modifier un joueur</h1>
    <form action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="POST" enctype="multipart/form-data">
        <div class="input-group">
            <input type="text" id="firstname" name="firstname" placeholder="Enter player first name" value="<?php echo htmlspecialchars($user['firstname']); ?>"><br>
        </div>
        <div class="input-group">
            <input type="text" id="lastname" name="lastname" placeholder="Enter player last name" value="<?php echo htmlspecialchars($user['lastname']); ?>"><br>
        </div>
        <div class="input-group">
            <input type="text" id="pseudo" name="pseudo" placeholder="Enter player pseudo" value="<?php echo htmlspecialchars($user['pseudo']); ?>"><br>
        </div>
        <div class="input-group">
            <input type="date" id="dob" name="dob" placeholder="Enter player date of birth" value="<?php echo htmlspecialchars($user['dob']); ?>"><br>
        </div>
        <div class="input-group">
            <input type="text" id="country" name="country" placeholder="Enter player country" value="<?php echo htmlspecialchars($user['country']); ?>"><br>
        </div>
        <div class="input-group">
            <input type="text" id="game" name="game" placeholder="Enter player game" value="<?php echo htmlspecialchars($user['game']); ?>"><br>
        </div>
        <div class="input-group">
            <input type="text" id="team" name="team" placeholder="Enter player team" value="<?php echo htmlspecialchars($user['team']); ?>"><br>
        </div>
        <div class="input-group">
            <textarea id="text" name="text" placeholder="Enter player description"><?php echo htmlspecialchars($user['text']); ?></textarea><br>
        </div>
        <div class="input-group">
                <input type="file" id="file" name="file" accept="image/png, image/jpeg">
            </div>
        <button type="submit">Update player</button>
        <p>Return to index <a href="welcome.php">Welcome</a></p>
    </form>
</div>

</body>
</html>
