<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'controller/controller.php';

$userController = new UserController();
$page = $_GET['page'] ?? 'accueil';

try {
    switch ($page) {
        case 'accueil':
           require 'view/pages/homeView.php';
            break;
        case 'univers':
            require 'view/pages/universeView.php';
            break;
        case 'connexion':
            require 'view/user/connectionView.php';
            break;
        case 'inscription':
            require 'view/user/registrationView.php';
            break;
        case 'fantasy':
            require 'view/pages/fantasyView.php';
            break;
        case 'dark-fantasy':
            require 'view/pages/darkFantasyView.php';
            break;
        case 'steampunk':
            require 'view/pages/steampunkView.php';
            break;
        case 'verification-inscription':
            if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $userController->validateRegistration($pseudo, $email, $password);
            } else {
                errorController::error('Veuillez remplir tous les champs !');
            }
            break;
        case 'validation-inscription':
            require 'view/pages/registrationValidateView.php';
            break;
        case 'erreur':
            require 'view/pages/errorView.php';
            break;
        default:
            require 'view/pages/homeView.php';
    }
}catch (Exception $e) {
    echo $error = $e->getMessage();
    require 'view/pages/errorView.php';
}
