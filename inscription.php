<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Inscription</h2>

    <?php
    include 'database.php'; // Inclure le fichier de connexion à la base de données

    // Vérifier si le formulaire est soumis
    if(isset($_POST['submit'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $motDePasse = $_POST['mot_de_passe'];
        $dateInscription = $_POST['date_inscription'];

        // Vérifier si l'email est déjà utilisé
        $stmt = $pdo->prepare("SELECT * FROM Membres WHERE Adresse_email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // L'utilisateur existe déjà, afficher un message d'erreur
            $error = "Un utilisateur avec cette adresse email existe déjà.";
        } else {
            // L'email est disponible, procéder à l'inscription
            // Hasher le mot de passe (vous pouvez utiliser des méthodes plus sécurisées comme bcrypt)
            $mdpHash = md5($motDePasse);

            // Insérer les données dans la base de données
            $stmt = $pdo->prepare("INSERT INTO Membres (Nom, Prénom, Adresse_email, Mot_de_passe, Date_inscription) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $mdpHash, $dateInscription]);

            session_start(); 
            $_SESSION['nom_utilisateur'] = $nom; // Nom de l'utilisateur inscrit

            // Rediriger l'utilisateur vers une page de confirmation ou une autre page de votre choix
            header("Location: index.php");
            exit(); // Arrêter le script
        }
    }
    ?>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div class="mb-3">
            <label for="date_inscription" class="form-label">Date d'inscription</label>
            <input type="date" class="form-control" id="date_inscription" name="date_inscription" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">S'inscrire</button>

        <a href="connexion.php">S'inscire</a>
    </form>
</div>

</body>
</html>
