<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'controller/controller.php';

global $errorMessage;

$userController = new UserController();
$commentsController = new CommentsController();
$page = $_GET['page'] ?? 'accueil';

try {
    switch ($page) {
        case 'accueil':
           require 'view/pages/homeView.php';
            break;
        case 'commentaires':
            require 'view/pages/newsView.php';
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
            try {
                if (SecurityController::isConnected()) {
                    throw new Exception('Vous êtes déjà connecté !');
                }else
                {
                    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                        $pseudo = htmlspecialchars($_POST['pseudo']);
                        $password = htmlspecialchars($_POST['password']);
                        $userController->verificationPseudo($pseudo);
                    }else {
                        throw new Exception('Veuillez remplir tous les champs !');
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require 'view/user/connectionView.php';
            }

            break;
        case 'profil':
            require 'view/user/profileUserView.php';
            break;
        case 'inscription':
            require 'view/user/registrationView.php';
            break;
        case 'registration':
            try {
                if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars(SecurityController::encrypt($_POST['password']));
                    $userController->registerVerification($pseudo, $email, $password);
                }else {
                    throw new Exception('Veuillez remplir tous les champs !');
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require 'view/user/registrationView.php';
            }
            break;
        case 'validation-inscription':
            require 'view/pages/registrationValidateView.php';
            break;
        case 'logout':
            $userController->logout();
        case 'add-comment':
            try {
                if (!SecurityController::isConnected()) {
                    throw new Exception('Vous devez être connecté pour poster un commentaire !');
                } else {
                    if (isset($_POST['submit_comment'])) {
                        if (!empty($_POST['message'])) {
                            $message = htmlspecialchars($_POST['message']);
                            $commentsController->postComment(htmlspecialchars($message));
                        }else {
                            throw new Exception('Veuillez remplir tous les champs !');
                        }
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require 'view/pages/newsView.php';
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
