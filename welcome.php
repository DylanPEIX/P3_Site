<?php
    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        exit();
    }

    // Inclure le fichier de connexion à la base de données
    include('includes/connect.php');
    $conn = connect();

    // Récupérer la liste des joueurs
    $req1 = "SELECT * FROM player ORDER BY id";
    $stmt1 = $conn->prepare($req1);
    $stmt1->execute();
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="CRUD/welcome.css">
</head>
<body>

    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Thank you for logging in.</p>
        <button><a href="includes/logout.php">Logout</a></button>
    </div>

    <a class="create-button" href="create.php">Create</a>

    <table class="table">
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result1 as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['pseudo']); ?></td>
                    <td><a href="update.php?id=<?php echo $row['id']; ?>"><img class="modif" src="CRUD/modif.png" style="width:20px;height:20px"></a></td>
                    <td><a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"><img class="supp" src="CRUD/supprimer.png" style="width:25px;height:25px"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
