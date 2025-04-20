<?php
require_once 'model/User.php';
class AuthController {
    public function login() {
        $errorMessage = ''; // Initialisation de la variable pour le message d'erreur
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['username'];
            $pass = $_POST['password'];
    
            // Récupérer l'utilisateur depuis la base de données
            $userData = User::getUserByUsername($user);  // Méthode getUserByUsername()
    
            // Vérifier si l'utilisateur existe et si le mot de passe est correct
            if ($userData && password_verify($pass, $userData['password_hash'])) {
                $_SESSION['user'] = $userData['username'];  // Stocke le nom d'utilisateur
                $_SESSION['user_id'] = $userData['id'];     // Stocke l'ID de l'utilisateur
                header("Location: index.php?page=dashboard");
                exit(); // Pour stopper l'exécution du script après la redirection
            } else {
                $errorMessage = "Identifiants invalides.";  // Message d'erreur en cas d'échec de la connexion
            }
        }
    
        // Afficher la page de login avec le message d'erreur, si présent
        include 'view/login.php';
    }
    
    
    public function signup() {
        $errorMessage = ''; // Initialisation de la variable pour le message d'erreur
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
    
            // Vérifie que les mots de passe correspondent
            if ($password === $confirm_password) {
                if (User::register($username, $password)) {
                    // Si l'inscription réussie
                    echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                    header("Location: index.php?page=login");
                    exit(); // Pour stopper l'exécution après la redirection
                } else {
                    $errorMessage = "Erreur d'inscription, essayez un autre nom d'utilisateur.";  // Message d'erreur si l'utilisateur existe déjà
                }
            } else {
                $errorMessage = "Les mots de passe ne correspondent pas.";  // Message d'erreur si les mots de passe ne correspondent pas
            }
        }
    
        // Afficher la page d'inscription avec le message d'erreur, si présent
        include 'view/signup.php';
    }
    
    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}
?>