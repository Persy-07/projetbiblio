<?php
include 'database.php';

// Vérifier si l'identifiant du livre à supprimer est présent dans l'URL
if(isset($_GET['id'])) {
    $id_livre = $_GET['id'];

    // Supprimer le livre de la base de données en utilisant l'identifiant
    $stmt = $pdo->prepare("DELETE FROM Livres WHERE id = ?");
    $stmt->execute([$id_livre]);

    // Rediriger vers une page de confirmation ou à une autre page après la suppression
    header("location: admin.php"); // Assurez-vous de rediriger vers la bonne page
    exit();
} else {
    // Si l'identifiant du livre n'est pas présent dans l'URL, afficher un message d'erreur ou rediriger vers une autre page
    echo "Identifiant du livre non spécifié.";
    exit();
}
?>
