<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.php';
$conn = connect();

if (isset($_GET['id_login']) && is_numeric($_GET['id_login'])) {
    $id = $_GET['id_login'];

    $stmt = $conn->prepare("SELECT * FROM log WHERE id_login = :id_login");
    $stmt->bindParam(':id_login', $id);
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
    if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        if ($_POST['password'] === $_POST['confirm_password']) {
            $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            echo "Les mots de passe ne correspondent pas.";
            exit();
        }
    } else {
        $newPassword = $user['password'];
    }

    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];

    $stmt = $conn->prepare("UPDATE log SET username = :username, email = :email, password = :password WHERE id_login = :id_login");
    $stmt->bindParam(':username', $newUsername);
    $stmt->bindParam(':email', $newEmail);
    $stmt->bindParam(':password', $newPassword);
    $stmt->bindParam(':id_login', $id);

    if ($stmt->execute()) {
        echo "Utilisateur mis à jour avec succès.";
        // Récupérer à nouveau les données mises à jour de la base de données
        $stmt = $conn->prepare("SELECT * FROM log WHERE id_login = :id_login");
        $stmt->bindParam(':id_login', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="login-container">
    <h1>Modifier un utilisateur</h1>
    <form action="update.php?id_login=<?php echo htmlspecialchars($id); ?>" method="POST">
        <div class="input-group">
            <input type="text" id="username" name="username" placeholder="Enter your username"  value="<?php echo htmlspecialchars($user['username']); ?>"><br>
        </div>
        <div class="input-group">
            <input type="email" id="email" name="email" placeholder="Enter your Email"  value="<?php echo htmlspecialchars($user['email']); ?>"><br>
        </div>
        <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Enter your password"  value=""><br>
        </div>
        <div class="input-group">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password"  value=""><br>
        </div>
        <button type="submit">Update</button>
        <p>Return to index <a href="welcome.php">Welcome</a></p>
    </form>
</div>

</body>
</html>
