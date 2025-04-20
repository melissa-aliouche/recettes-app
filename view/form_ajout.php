<?php include 'view/templates/header.php'; ?>
<h2>Ajouter une recette</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Titre : <input type="text" name="titre" required></label><br>
    <label>Description : <textarea name="description" required></textarea></label><br>
    <label>Ingrédients : <textarea name="ingredients" required></textarea></label><br>
    <label>Instructions : <textarea name="instructions" required></textarea></label><br>
    <label>Durée (en minutes) : <input type="number" name="duree" required></label><br>
    <label>Image : <input type="file" name="image" accept="image/*"></label><br>
    <button type="submit">Ajouter la recette</button>
</form>
<?php include 'view/templates/footer.php'; ?>
