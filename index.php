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

// On détermine le nombre de joueurs par page
$parPage = 18;

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My playerbase</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <div class="container text-center">
        <h1 class="my-5">Playerbase</h1>
        <div class="row row-cols-5">
            <?php foreach ($players as $player): 
                $id = $player['id'];
                ?>
            <div class="col-md-2 mb-4">
                <div class="card">
                    <img src="tenz.png" class="card-img-top" alt="Player Image">
                    <div class="card-body">
                        <h5 class="card-title mb-0"><?php echo $player['pseudo']; ?></h5>
                        <p class="card-text mb-0">Game: <?php echo $player['game']; ?></p>
                        <p class="card-text mb-1">Team: <?php echo $player['team']; ?></p>
                        <div class="d-grid gap-2 justify-content-md-end">
                            <button class="btn btn-primary" type="button" onclick="openModal(<?php echo $id;?>)" >See more</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>


        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <!-- Page précédente -->
                <?php if ($currentPage > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">&lsaquo;</a>
                </li>
                <?php endif; ?>

                <!-- Première page -->
                <?php if ($currentPage > 2): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=1">1</a>
                </li>
                <?php elseif ($currentPage == 2): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=1">1</a>
                </li>
                <?php endif; ?>

                <!-- Page précédente -->
                <?php if ($currentPage > 2): ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">...</a>
                </li>
                <?php endif; ?>

                <!-- Page actuelle -->
                <li class="page-item active">
                    <a class="page-link" href="#"><?php echo $currentPage; ?></a>
                </li>

                <!-- Page suivante -->
                <?php if ($currentPage < $pages - 1): ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">...</a>
                </li>
                <?php endif; ?>

                <!-- Dernière page -->
                <?php if ($currentPage < $pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $pages; ?>"><?php echo $pages; ?></a>
                </li>
                <?php endif; ?>

                <!-- Page suivante -->
                <?php if ($currentPage < $pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">&rsaquo;</a>
                </li>
                <?php endif; ?>
                
            </ul>
        </nav>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <iframe id="iframeDetail" src=""></iframe> <!-- Contenu à afficher dans la boîte modale -->
        </div>
    </div>

        <script>
            // Fonction pour ouvrir la boîte modale avec l'ID du block
            function openModal(id) {
                document.getElementById("myModal").style.display = "block";
                document.getElementById("iframeDetail").src = "detail.php?id=" + id;
            }

            // Fonction pour fermer la boîte modale
            function closeModal() {
                document.getElementById("myModal").style.display = "none";
            }
        </script>
</body>
</html>

