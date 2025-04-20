<?php include 'view/templates/header.php'; ?>

<h2 class="mb-4">Liste des recettes</h2>
<form method="GET" class="search-bar mb-4" >
    <input type="text" name="search" class="form-control ps-5" 
           placeholder="🔍 Rechercher une recette..." 
           value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <i class="bi bi-search" ></i>
</form>


<div class="row">
    <?php foreach ($recettes as $r): ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <?php if (!empty($r['image_url'])): ?>
                    <img src="<?= htmlspecialchars($r['image_url']) ?>" class="card-img-top" alt="Image de <?= htmlspecialchars($r['titre']) ?>">
                <?php endif; ?>
                <div class="card-body">
                    <!-- Auteur + Date -->
                    <p class="text-muted mb-2">
                        <i class="fas fa-user-circle me-1"></i>
                        <small><strong><?= htmlspecialchars($r['username']) ?></strong>
                        <?php if (!empty($r['created_at'])): ?>
                            - <i class="far fa-calendar-alt ms-2"></i>
                            <?= date('d/m/Y', strtotime($r['created_at'])) ?>
                        <?php endif; ?>
                        </small>
                    </p>

                    <!-- Titre + contenu -->
                    <h5 class="card-title"><?= htmlspecialchars($r['titre']) ?></h5>
                    <p class="card-text"><strong>Description :</strong> <?= htmlspecialchars($r['description']) ?></p>
                    <p class="card-text"><strong>Ingrédients :</strong> <?= htmlspecialchars($r['ingredients']) ?></p>
                    <p class="card-text"><strong>Instructions :</strong> <?= htmlspecialchars($r['instructions']) ?></p>
                    <p class="card-text"><strong>Durée :</strong> <?= htmlspecialchars($r['duree']) ?> minutes</p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'view/templates/footer.php'; ?>
