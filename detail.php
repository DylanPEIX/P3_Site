<?php
// On se connecte à la base de données
include('includes/connect.php');
$conn = connect();

// On détermine le nombre total de joueurs
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $sql = 'SELECT * FROM `player`';
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My playerbase</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Ajoutez du CSS personnalisé ici si nécessaire */
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Player Details
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Player Name: <?php echo $result['firstname'] . ' ' . $result['lastname']; ?></h5>
                        <p class="card-text">Pseudo: <?php echo $result['pseudo']; ?></p>
                        <p class="card-text">Birthday: <?php echo $result['dob']; ?></p>
                        <p class="card-text">Country: <?php echo $result['country']; ?></p>
                        <p class="card-text">Game: <?php echo $result['game']; ?></p>
                        <p class="card-text">Team: <?php echo $result['team']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
