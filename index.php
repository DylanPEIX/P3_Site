<?php
// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) $_GET['page'];
} else {
    $currentPage = 1;
}

// On se connecte à la base de données
include('includes/connect.php');
$conn = connect();

// On détermine le nombre total de joueurs
$sql = 'SELECT COUNT(*) AS players FROM `player`;';
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch();
$allplayers = (int) $result['players'];

// On détermine le nombre d'articles par page
$parPage = 10;

// On calcule le nombre de pages total
$pages = ceil($allplayers / $parPage);

// Calcul du 1er joueur de la page
$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT * FROM `player` ORDER BY `id` LIMIT :premier, :parpage;';
$query = $conn->prepare($sql);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$query->execute();
$players = $query->fetchAll(PDO::FETCH_ASSOC);

include('includes/close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des joueurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="col">
            <section class="col-12">
                <h1>Liste des joueurs</h1>
                <?php if(empty($players)): ?>
                    <p>Aucun joueur trouvé.</p>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pseudo</th>
                                <th>Jeux</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($players as $player): ?>
                                <tr>
                                    <td><?= $player['id'] ?></td>
                                    <td><?= $player['pseudo'] ?></td>
                                    <td><?= $player['game'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <nav>
                    <ul class="pagination">
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                        <li class="page-item <?= ($currentPage == $pages || $pages == 0) ? "disabled" : "" ?>">
                            <a href="?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </main>
</body>
</html>
