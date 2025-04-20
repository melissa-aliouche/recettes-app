<?php
class Database {
    public static function connect() {
        try {
            // Connexion à la base de données en utilisant PDO
            $pdo = new PDO('mysql:host=localhost;dbname=recettes;charset=utf8', 'username', 'password');
            // Configuration des attributs de PDO pour mieux gérer les erreurs
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;  // Retourne l'objet PDO pour une utilisation ultérieure
        } catch (PDOException $e) {
            // En cas d'échec, on arrête l'exécution du script avec le message d'erreur
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}
?>
