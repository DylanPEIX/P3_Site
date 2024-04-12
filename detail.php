<?php
// On se connecte à la base de données
include('includes/connect.php');
$conn = connect();

$player = false; // Aucun joueur trouvé

// Vérification de l'existence de l'ID et s'il est numérique
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = 'SELECT * FROM `player` WHERE id = :id LIMIT 1'; // Utilisation d'un paramètre nommé pour la préparation de la requête
    $query = $conn->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT); // Liaison du paramètre nommé avec la valeur de $id
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC); // Utilisation de PDO::FETCH_ASSOC pour récupérer un tableau associatif

    $player = $result;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="my-5">Player Details</h1>
        <?php if ($player): ?>
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="player-details">
                    <div class="row">
                        <div class="col-md-auto d-flex align-items-center justify-content-center">
                            <img src="tenz.png" class="img-fluid player-image rounded-circle" alt="Player Image">
                        </div>
                        <div class="col-md-auto m-auto">
                            <h2 class="text-center"><?php echo $player['pseudo']; ?></h2>
                            <p class="text-center">Name: <?php echo $player['firstname'] . ' ' . $player['lastname']; ?></p>
                            <div class="row">
                                <div class="col-md-auto text-center">Birthday: <?php echo $player['dob']; ?></div>
                                <div class="col-md-auto text-center">Country: <?php echo $player['country']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-center">Game: <?php echo $player['game']; ?></div>
                                <div class="col-md-6 text-center">Team: <?php echo $player['team']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <div class="player-description">
                    <p class="text-center"><?php echo $player['text']; ?></p>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Joueur non trouvé.
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
