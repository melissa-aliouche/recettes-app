<?php
require_once 'model/Recette.php';

class RecetteController {
    public function accueil() {
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $recettes = Recette::searchByTitre($_GET['search']);
        } else {
            $recettes = Recette::getAll();
        }
    
        include 'view/accueil.php';
    }
    

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM recettes WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $recettes = $stmt->fetchAll();

        include 'view/dashboard.php';
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $ingredients = $_POST['ingredients'];
            $instructions = $_POST['instructions'];
            $duree = $_POST['duree'];
            $userId = $_SESSION['user_id']; // 🔐 Associer l'utilisateur
    
            // Gestion du fichier image
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadDir = 'img/';  // Dossier où stocker l'image
                $imageName = uniqid() . '_' . basename($_FILES['image']['name']);  // Nom unique pour éviter les collisions
                $imagePath = $uploadDir . $imageName;
    
                // Déplacer le fichier téléchargé vers le dossier "img/"
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            }
    
            // Enregistrement dans la base de données
            $pdo = Database::connect();
            $stmt = $pdo->prepare("INSERT INTO recettes (titre, description, ingredients, instructions, duree, image_url, user_id) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$titre, $description, $ingredients, $instructions, $duree, $imagePath, $userId]);
    
            header("Location: index.php?page=dashboard");
        } else {
            include 'view/form_ajout.php';
        }
    }
    

    public function modifier($id) {
        $pdo = Database::connect();
    
        // S'assurer que la recette appartient à l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM recettes WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $_SESSION['user_id']]);
        $recette = $stmt->fetch();
    
        if (!$recette) {
            die("Accès non autorisé.");
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $ingredients = $_POST['ingredients'];
            $instructions = $_POST['instructions'];
            $duree = $_POST['duree'];
    
            // Gestion de l'image
            $imageUrl = $recette['image_url']; // Image par défaut (ancienne image)
    
            if (!empty($_FILES['image']['name'])) {
                // Nouveau fichier image téléchargé
                $imageFile = $_FILES['image'];
                $uploadDir = 'img/'; // Dossier où stocker l'image
                $imageFileName = basename($imageFile['name']);
                $uploadFile = $uploadDir . $imageFileName;
    
                if (move_uploaded_file($imageFile['tmp_name'], $uploadFile)) {
                    $imageUrl = $uploadFile; // Met à jour le chemin de l'image
                }
            }
    
            // Mise à jour de la recette dans la base de données
            $stmt = $pdo->prepare("UPDATE recettes SET titre = ?, description = ?, ingredients = ?, instructions = ?, duree = ?, image_url = ? WHERE id = ?");
            $stmt->execute([$titre, $description, $ingredients, $instructions, $duree, $imageUrl, $id]);
    
            header("Location: index.php?page=dashboard");
        } else {
            include 'view/form_modif.php';
        }
    }
    

    public function supprimer($id) {
        $pdo = Database::connect();

        // Vérifie que la recette appartient à l'utilisateur connecté
        $stmt = $pdo->prepare("DELETE FROM recettes WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $_SESSION['user_id']]);

        header("Location: index.php?page=dashboard");
    }
}
?>
