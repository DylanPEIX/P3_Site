<?php
session_start();
include ('includes/db.php');
$conn = connect();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

if(isset($_GET['id_login'])){
    $id = intval($_GET['id_login']); // Convertir en entier
    $sql = "DELETE FROM log WHERE id_login=:id_login"; // Supprimer les guillemets autour de id_login

    $query = $conn->prepare($sql);

    $query->bindValue(':id_login', $id, PDO::PARAM_INT); // Utiliser id_login plutôt que id dans bindValue
    $query->execute();

    header('Location: welcome.php');
    exit(); // Ajouter exit() après la redirection pour arrêter l'exécution du script
}
?>

