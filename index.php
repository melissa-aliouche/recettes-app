<?php

ini_set("session.save_path", "./sessions");
session_start();
require_once 'controller/AuthController.php';
require_once 'controller/RecetteController.php';
$page = $_GET['page'] ?? 'accueil';
switch ($page) {
    case 'login':
        (new AuthController())->login();
        break;
    case 'signup':
        (new AuthController())->signup(); // Nouveau case pour l'inscription
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'dashboard':
        (new RecetteController())->dashboard();
        break;
    case 'ajouter':
        (new RecetteController())->ajouter();
        break;
    case 'modifier':
        (new RecetteController())->modifier($_GET['id']);
        break;
    case 'supprimer':
        (new RecetteController())->supprimer($_GET['id']);
        break;
    default:
        (new RecetteController())->accueil();
        break;
}
?>