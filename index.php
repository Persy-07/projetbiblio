<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Liste des Livres</title>
    <style>

.book-image {
            max-height: 200px; /* Définissez la hauteur maximale de l'image */
            object-fit: contain; /* Permet à l'image de conserver ses proportions */
        }

        .user-name {
            font-weight: bold;
            color: #007bff;
        }
        .yellow-bg {
            background-color: #192c53;
            padding-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="yellow-bg">
        <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                        <span class="fs-4 text-light">Ma Bibliothèque</span>
                    </a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
 
                    </ul>
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" class="form-control" placeholder="Recherche..." aria-label="Search">
                    </form>
                    <div class="text-end">
                        <?php    
                        if (isset($_SESSION['nom_utilisateur'])) {
                            echo "<span class='user-name'>Bienvenue, " . $_SESSION['nom_utilisateur'] . "!</span>";
                        } else {
                            echo "<span class='user-name'>Bienvenue, visiteur!</span>";
                        }   
                        ?>
                        <a type="button" href="connexion.php" class="btn btn-outline-primary ms-3">Se déconnecter</a>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div class="container">
        <h1 class="mb-4">Liste des Livres</h1>
        <div class="row">
            <?php
            // Connexion à la base de données
            include 'database.php';

            // Sélectionner tous les livres avec leurs catégories
            $query = "SELECT * FROM livres";
            $stmt = $pdo->query($query);

            // Parcourir les résultats et afficher chaque livre dans une carte Bootstrap
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="image/<?php echo $row['Image']; ?>" class="card-img-top book-image" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['Titre']; ?></h5>
                            <p class="card-text"><strong>Auteur:</strong> <?php echo $row['Auteur']; ?></p>
                            <p class="card-text"><strong>Catégorie:</strong> <?php echo $row['Catégorie']; ?></p>
                            <p class="card-text"><strong>Année de publication:</strong> <?php echo $row['Année_de_publication']; ?></p>
                            <p class="card-text"><strong>Résumé:</strong> <?php echo $row['Résumé']; ?></p>
                            <p class="card-text"><strong>Disponibilité:</strong> <?php echo $row['Disponibilité'] ? 'Disponible' : 'Non disponible'; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
