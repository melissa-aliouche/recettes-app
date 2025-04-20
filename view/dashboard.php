<?php include 'view/templates/header.php'; ?>
<h2>Tableau de bord</h2>
<p>Bienvenue <?= htmlspecialchars($_SESSION['user']) ?></p>

<!-- Icône + texte pour ajouter une recette -->
<a href="index.php?page=ajouter" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Ajouter une recette
</a>

<ul class="liste-recettes">
<?php foreach ($recettes as $r): ?>
    <li class="recette-item">
        <strong><?= htmlspecialchars($r['titre']) ?></strong>
        <a href="index.php?page=modifier&id=<?= $r['id'] ?>" class="text-primary icon-action" title="Modifier">
            <i class="fas fa-edit"></i>
        </a>
        <a href="index.php?page=supprimer&id=<?= $r['id'] ?>" class="text-danger icon-action" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">
            <i class="fas fa-trash-alt"></i>
        </a>
    </li>
<?php endforeach; ?>
</ul>

<a href="index.php?page=logout" class="btn btn-outline-secondary mt-4">
    <i class="fas fa-sign-out-alt"></i> Déconnexion
</a>
<?php include 'view/templates/footer.php'; ?>
