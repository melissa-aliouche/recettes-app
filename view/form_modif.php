<?php include 'view/templates/header.php'; ?>
<h2>Modifier la recette</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Titre : <input type="text" name="titre" value="<?= htmlspecialchars($recette['titre']) ?>" required></label><br>
    <label>Description : <textarea name="description" required><?= htmlspecialchars($recette['description']) ?></textarea></label><br>
    <label>Ingrédients : <textarea name="ingredients" required><?= htmlspecialchars($recette['ingredients']) ?></textarea></label><br>
    <label>Instructions : <textarea name="instructions" required><?= htmlspecialchars($recette['instructions']) ?></textarea></label><br>
    <label>Durée (en minutes) : <input type="number" name="duree" value="<?= $recette['duree'] ?>" required></label><br>
    
    <?php if (!empty($recette['image_url'])): ?>
        <!-- Affichage de l'image actuelle -->
        <div>
            <img src="<?= htmlspecialchars($recette['image_url']) ?>" class="card-img-top" alt="Image actuelle de la recette">
        </div>
    <?php endif; ?>

    <label>Nouvelle image (optionnel) : <input type="file" name="image"></label><br>

    <button type="submit">Modifier la recette</button>
</form>
<?php include 'view/templates/footer.php'; ?>
