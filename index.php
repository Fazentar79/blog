<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'controller/controller.php';

global $errorMessage;
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
            if (SecurityController::isConnected()) {
                require 'view/user/profileUserView.php';
            }else {
                require 'view/user/connectionView.php';
            }
            break;
        case 'connection':
                if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                    $pseudo = SecurityController::secure($_POST['pseudo']);
                    $password = SecurityController::secure($_POST['password']);
                    $userController->validationConnection($pseudo, $password);
                }else {
                    throw new Exception('Veuillez remplir tous les champs !');
                }
            break;
        case 'profil':
            require 'view/user/profileUserView.php';
            break;
        case 'inscription':
            require 'view/user/registrationView.php';
            break;
        case 'registration':
                if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                    $pseudo = SecurityController::secure($_POST['pseudo']);
                    $email = SecurityController::secure($_POST['email']);
                    $password = SecurityController::secure($_POST['password']);
                    $userController->registerVerification($pseudo, $email, $password);
                }else {
                    throw new Exception('Veuillez remplir tous les champs !');
                }
            break;
        case 'validation-inscription':
            require 'view/pages/registrationValidateView.php';
            break;
        case 'logout':
            $userController->logout();
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
        case 'erreur':
            require 'view/pages/errorView.php';
            break;
        default:
            header('Location: erreur');
            throw new Exception($errorMessage('Page introuvable !'));
    }
}catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require 'view/pages/errorView.php';
}
