<?php
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}
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

<?php
    include('includes/db.php');
    $conn = connect();

    $req1 = "SELECT * FROM log";
    $stmt1 = $conn->prepare($req1);
    $stmt1->execute();
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>

<a class="create-button" href="create.php">Create</a>

<table class="table">
<thead>
    <tr>
        <th>Identifiant</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
</thead>

<tbody>
    <?php
        foreach($result1 as $row){
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td> <a href='update.php?id_login=" . $row['id_login'] . "'> <img class='modif' src='assets/modif.png' style='width:20px;height:20px'> </a> </td>";
            echo "<td> <a href='delete.php?id_login=" . $row['id_login'] . "' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')\"> <img class='supp' src='assets/supprimer.png' style='width:25px;height:25px'> <i class='fas fa-trash-alt'></i> </a> </td>"  ;
            echo "</tr>"; 
        }
    ?>
</tbody>
</table>

</body>
</html>
