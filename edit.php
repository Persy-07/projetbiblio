<?php
include 'database.php';

// Vérifier si l'identifiant du livre à modifier est présent dans l'URL
if(isset($_GET['id'])) {
    $id_livre = $_GET['id'];

    // Récupérer les détails du livre à modifier depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM Livres WHERE id = ?");
    $stmt->execute([$id_livre]);
    $livre = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le formulaire de modification a été soumis
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

                // Mettre à jour le livre dans la base de données avec le nouveau nom de l'image
                $stmt = $pdo->prepare("UPDATE Livres SET Titre=?, Auteur=?, Catégorie=?, Année_de_publication=?, Résumé=?, Disponibilité=?, Image=? WHERE id=?");
                $stmt->execute([$titre, $auteur, $categorie, $annee, $resume, $disponibilite, $nomImage, $id_livre]);

                // Rediriger vers une page de confirmation ou de liste des livres après la modification
                header("location: admin.php");
                exit();
            } else {
                echo 'Ce type de fichier est interdit';
            }
        } else {
            echo 'Une erreur est survenue lors de l\'envoi du fichier';
        }
    }
} else {
    // Si l'identifiant du livre n'est pas présent dans l'URL, afficher un message d'erreur ou rediriger vers une autre page
    echo "Identifiant du livre non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier un livre - Bibliothèque</title>
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
                                    <h2 class="fw-bold mb-2 text-center">Modifier un livre :</h2>
                                    <form enctype="multipart/form-data" action="" method="post">
                                        <div class="mb-4">
                                            <label for="titre" class="form-label">Titre du livre</label>
                                            <input type="text" name="titre" class="form-control form-control-lg" placeholder="Entrez le titre:" value="<?= $livre['Titre'] ?>" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="auteur" class="form-label">Auteur</label>
                                            <input type="text" name="auteur" class="form-control form-control-lg" placeholder="Entrez l'auteur:" value="<?= $livre['Auteur'] ?>" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="categorie" class="form-label">Catégorie</label>
                                            <input type="text" name="categorie" class="form-control form-control-lg" placeholder="Entrez la catégorie:" value="<?= $livre['Catégorie'] ?>" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="annee" class="form-label">Année de publication</label>
                                            <input type="number" name="annee" class="form-control form-control-lg" placeholder="Entrez l'année de publication:" value="<?= $livre['Année_de_publication'] ?>" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="resume" class="form-label">Résumé</label>
                                            <textarea name="resume" class="form-control form-control-lg" placeholder="Entrez le résumé:" rows="4"><?= $livre['Résumé'] ?></textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="disponibilite" class="form-label">Disponibilité</label>
                                            <select name="disponibilite" class="form-control form-control-lg">
                                                <option value="1" <?php if($livre['Disponibilité'] == 1) echo "selected"; ?>>Disponible</option>
                                                <option value="0" <?php if($livre['Disponibilité'] == 0) echo "selected"; ?>>Non disponible</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Télécharger la photo du livre :</label>
                                            <input type="file" accept=".png" class="form-control" name="photo" />
                                        </div>
                                        <input type="submit" class="btn btn-success" name="btn" value="Enregistrer les modifications">
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
