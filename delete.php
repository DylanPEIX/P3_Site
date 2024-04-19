<?php
    session_start();
    include ('includes/connect.php');
    $conn = connect();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        exit();   
    }

    //include ('includes/connect.php'); // Inclure le fichier db.php
    if(isset($_GET['id'])){
        $id = intval($_GET['id']); // Convertir en entier
        $sql = "DELETE FROM player WHERE id=:id"; // Supprimer les guillemets autour de id_login

        $query = $conn->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT); // Utiliser id_login plutôt que id dans bindValue
        $query->execute();

        header('Location: welcome.php');
        exit(); // Ajouter exit() après la redirection pour arrêter l'exécution du script
    }
?>

