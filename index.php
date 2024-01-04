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
            try {
                if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $userController->registerVerification($pseudo, $email, $password);
                }else {
                    throw new Exception('Veuillez remplir tous les champs !');
                }
            }catch (Exception $e) {
                $error = $e->getMessage();
            }
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
        case 'Erreur':
            require 'view/pages/errorView.php';
            break;
        case 'validation-inscription':
            require 'view/pages/registrationValidateView.php';
            break;
        default:
            require 'view/pages/homeView.php';
    }
}catch (Exception $e) {
    $error = $e->getMessage();
}
