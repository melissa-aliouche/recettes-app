<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de recettes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">🍽️ Recettes</a>
        
        <!-- Bouton hamburger pour les petits écrans -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>

                <!-- Afficher les liens pour les utilisateurs connectés -->
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=dashboard"><i class="fas fa-list"></i> Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=ajouter"><i class="fas fa-plus"></i> Ajouter une recette</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                    </li>
                <?php else: ?>
                    <!-- Afficher les liens pour les utilisateurs non connectés -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                    </li>
                    <!-- Lien vers l'inscription uniquement si l'utilisateur n'est pas connecté -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=signup"><i class="fas fa-user-plus"></i> Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Afficher le nom de l'utilisateur connecté -->
            <?php if (isset($_SESSION['user'])): ?>
                <span class="navbar-text text-light">
                    Connecté en tant que <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>
                </span>
            <?php endif; ?>

        </div>
    </div>
</nav>


<!-- Contenu principal de la page -->
<div class="container">
