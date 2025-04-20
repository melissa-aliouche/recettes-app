<?php
require_once 'Database.php';

class Recette {
    public static function getAll() {
        $pdo = Database::connect();
        $sql = "SELECT recettes.*, users.username 
                FROM recettes 
                LEFT JOIN users ON recettes.user_id = users.id";
        return $pdo->query($sql)->fetchAll();
    }
    public static function searchByTitre($titre) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT r.*, u.username FROM recettes r 
                               JOIN users u ON r.user_id = u.id 
                               WHERE r.titre LIKE ?");
        $stmt->execute(["%$titre%"]);
        return $stmt->fetchAll();
    }
    
}
?>
