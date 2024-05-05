<?php
include 'database.php';

if(isset($_POST["btn"])) {
    // Récupérer les données du formulaire
    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];
    $categorie = $_POST["categorie"];
    $annee = $_POST["annee"];
    $resume = $_POST["resume"];
    $disponibilite = $_POST["disponibilite"];

    // Vérifier si l'image a été téléchargée sans erreur
    if(isset($_FILES['photo']) && !$_FILES['photo']['error']) {
        $extensions = array('jpg', 'png', 'gif', 'jpeg', 'PNG');
        $fileInfo = pathinfo($_FILES['photo']['name']);
        if (in_array($fileInfo['extension'], $extensions)) {
            // Chemin de stockage de l'image
            $nomImage = $titre . ".png"; // Nom de l'image basé sur le titre du livre
            $chemin = "image/" . $nomImage; // Chemin relatif vers le répertoire des images

            // Déplacer le fichier téléchargé vers le chemin de stockage
            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

            // Enregistrer le livre avec le nom de l'image dans la base de données
            $stmt = $pdo->prepare("INSERT INTO Livres (Titre, Auteur, Catégorie, Année_de_publication, Résumé, Disponibilité, Image) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$titre, $auteur, $categorie, $annee, $resume, $disponibilite, $nomImage]);

            header("location:admin.php");
            exit();
        } else {
            echo 'Ce type de fichier est interdit';
        }
    } else {
        echo 'Une erreur est survenue lors de l\'envoi du fichier';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter un livre - Bibliothèque</title>

</head>


<body style="background-color: #f2edf3">
    <div class="container-scroller">
    

        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper container">
                    <div class="row">
                        <div class="grid-margin  stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="fw-bold mb-2 text-center">Ajouter un nouveau livre :</h2>
                                    <form enctype="multipart/form-data" action="" method="post">
                                        <div class="mb-4">
                                            <label for="titre" class="form-label">Titre du livre</label>
                                            <input type="text" name="titre" class="form-control form-control-lg" placeholder="Entrez le titre:" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="auteur" class="form-label">Auteur</label>
                                            <input type="text" name="auteur" class="form-control form-control-lg" placeholder="Entrez l'auteur:" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="categorie" class="form-label">Catégorie</label>
                                            <input type="text" name="categorie" class="form-control form-control-lg" placeholder="Entrez la catégorie:" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="annee" class="form-label">Année de publication</label>
                                            <input type="number" name="annee" class="form-control form-control-lg" placeholder="Entrez l'année de publication:" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="resume" class="form-label">Résumé</label>
                                            <textarea name="resume" class="form-control form-control-lg" placeholder="Entrez le résumé:" rows="4"></textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="disponibilite" class="form-label">Disponibilité</label>
                                            <select name="disponibilite" class="form-control form-control-lg">
                                                <option value="1">Disponible</option>
                                                <option value="0">Non disponible</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Télécharger la photo du livre :</label>
                                            <input type="file" accept=".png" class="form-control" name="photo" />
                                        </div>
                                        <form enctype="multipart/form-data" action="" method="post">
    <!-- Autres champs du formulaire -->
                                         <input type="hidden" name="id" value="<?php echo $id_livre; ?>" />
                                            <input class="btn btn-success" name="btn" type="submit" value="Enregistrer">
                                         </form>
 
                                    </form>
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
