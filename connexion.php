<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .error-message {
            margin-top: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Connexion</h2>

    <?php
    session_start(); // Démarrer la session

    // Vérifier si le formulaire est soumis
    if(isset($_POST['submit'])) {
        include 'database.php'; // Inclure le fichier de connexion à la base de données

        // Récupérer les données du formulaire
        $email = $_POST['email'];
        $motDePasse = $_POST['mot_de_passe'];

        // Hasher le mot de passe pour le comparer avec celui stocké dans la base de données
        $mdpHash = md5($motDePasse);

        // Vérifier les identifiants dans la base de données
        $stmt = $pdo->prepare("SELECT * FROM Membres WHERE Adresse_email = ? AND Mot_de_passe = ?");
        $stmt->execute([$email, $mdpHash]);
        $user = $stmt->fetch();

        if ($user) {
            // Authentification réussie, enregistrer les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['user_email'] = $user['Adresse_email'];

            $_SESSION['nom_utilisateur'] = $email; 
            // Rediriger l'utilisateur vers la page d'accueil ou une autre page de votre choix
            header("Location: index.php");
            exit(); // Arrêter le script
        } else {
            // Authentification échouée, afficher un message d'erreur
            $error = "Adresse email ou mot de passe incorrect.";
        }
    }
    ?>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger error-message" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="submit">Se connecter</button>

        <a href="inscription.php" class="btn btn-link btn-block">Inscription</a>
    </form>
</div>

</body>
</html>
