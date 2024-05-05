<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes annonces</title>
    <!-- Ajoutez vos liens vers les fichiers CSS et JavaScript ici -->
</head>
<body style="background-color: #f2edf3">
    <div class="container-scroller">
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper container">
                    <div class="row">
                        <div class="grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h1>Mes Livres</h1>

                                    <a href="ajoutlivre.php">Ajouter un livre</a>
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Photo</th>
                                            <th>Titre</th>
                                            <th>Auteur</th>
                                            <th>Catégorie</th>
                                            <th>Année de publication</th>
                                            <th>Résumé</th>
                                            <th>Disponibilité</th>
                                            <th>Action</th> <!-- Nouvelle colonne pour les actions -->
                                        </tr>
                                        <?php
                                        include 'database.php';
                                        // Sélectionnez toutes les annonces de la table Livres
                                        $stmt = $pdo->query('SELECT * FROM Livres');
                                        while ($row = $stmt->fetch()) {
                                            // Récupérez le nom de la catégorie


                                            // Affichez les détails de chaque livre dans un tableau
                                            echo "<tr>";
                                            echo "<td><img src='image/" . $row['Image'] . "' width='60'></img>";
                                            echo "<td>" . $row['Titre'] . "</td>";
                                            echo "<td>" . $row['Auteur'] . "</td>";
                                            echo "<td>" . $row['Catégorie'] . "</td>";  
                                            echo "<td>" . $row['Année_de_publication'] . "</td>";
                                            echo "<td>" . $row['Résumé'] . "</td>";
                                            echo "<td>" . ($row['Disponibilité'] ? 'Disponible' : 'Non disponible') . "</td>";
                                            // Ajout du bouton Modifier avec un lien vers la page de modification du livre
                                            echo "<td><a href='edit.php?id=" . $row['ID'] . "'>Modifier</a></td>";
                                            echo "<td><a href='supprimer.php?id=" . $row['ID'] . "'>Supprimer</a></td>";
                                 
                                            echo "</tr>";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
