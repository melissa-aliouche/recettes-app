<?php
require_once 'Database.php';
class User {
    public static function checkLogin($username, $password) {
        // Connexion à la base de données
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
    
        if ($user && password_verify($password, $user['password_hash'])) {
            return true; // Connexion réussie
        }
    
        return false; // Échec de la connexion
    }
    

    // Méthode pour inscrire un utilisateur
    public static function register($username, $password) {
        // Connexion à la base de données via la méthode statique connect()
        $connection = Database::connect();  
    
        // Vérification si l'utilisateur existe déjà
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return false; // L'utilisateur existe déjà
        }
    
        // Hachage du mot de passe avant de l'insérer dans la colonne password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Si l'utilisateur n'existe pas, on l'ajoute à la base de données
        $query = "INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password_hash', $hashedPassword);
        return $stmt->execute();  // Retourne true si l'insertion réussie
    }
    public static function getUserByUsername($username) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    
    
}
?>