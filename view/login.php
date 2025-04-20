<?php include 'view/templates/header.php'; ?>

<h2>Connexion</h2>

<?php if (!empty($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($errorMessage) ?>  <!-- Affichage du message d'erreur -->
    </div>
<?php endif; ?>

<form method="post">
    <label>Nom d'utilisateur : <input type="text" name="username" required></label><br>
    <label>Mot de passe : <input type="password" name="password" required></label><br>
    <button type="submit">Se connecter</button>
</form>

<?php include 'view/templates/footer.php'; ?>
