<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'controller/controller.php';

global $errorMessage;

$userController = new UserController();
$commentsController = new CommentsController();
$articlesController = new ArticlesController();
$page = $_GET['page'] ?? 'accueil';

try {
    switch ($page) {
        case 'accueil':
           require 'view/pages/homeView.php';
            break;
        case 'commentaires':
            require 'view/pages/commentsView.php';
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
                    throw new Exception('Veuillez remplir tous les champs.');
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
        case 'connection':
            try {
                if (SecurityController::isConnected()) {
                    throw new Exception('Vous êtes déjà connecté.');
                }else
                {
                    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                        $pseudo = htmlspecialchars($_POST['pseudo']);
                        $password = htmlspecialchars($_POST['password']);
                        $userController->verificationPseudo($pseudo);
                    }else {
                        throw new Exception('Veuillez remplir tous les champs.');
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
        case 'suppress-account':
            try {
                if (SecurityController::isConnected()) {
                    $userController->suppressAccount($_SESSION['pseudo']);
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require 'view/user/profileUserView.php';
            }
            break;
        case 'add-news':
        try {
            if (isset($_POST['submit_news'])) {
                if (!empty($_POST['news'])) {
                    $news = htmlspecialchars($_POST['news']);
                    if ($_SESSION['role'] == 1) {
                        $articlesController->addArticle($news);
                    }else {
                            throw new Exception('Vous n\'avez pas les droits pour publier une news.');
                    }
                }else {
                    throw new Exception('Veuillez remplir tous les champs.');
                }
            }
        }catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require 'view/pages/homeView.php';
        }
            break;
        case 'modify-article':
            try {
                if (isset($_POST['modify_article'])) {
                    $article_id = htmlspecialchars($_POST['id_article']);
                    $modify_news = htmlspecialchars($_POST['modify_news']);

                    if ($articlesController->getNewsArticles($article_id) && $_SESSION['role'] == 1) {
                        $articlesController->modifyArticle($article_id, $modify_news);
                    }else {
                        throw new Exception('Cette news n\'existe pas ou une erreur est survenue.');
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require 'view/pages/homeView.php';
            }
            break;
        case 'delete-article':
            try {
                if (isset($_POST['delete_article'])) {
                    $article_id = htmlspecialchars($_POST['id_article']);

                    if ($articlesController->getNewsArticles($article_id) && $_SESSION['role'] == 1) {
                        $articlesController->deleteArticle($article_id);
                    }else {
                        throw new Exception('Cette news n\'existe pas ou une erreur est survenue.');
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require 'view/pages/homeView.php';
            }
            break;
        case 'add-comment':
            try {
                if (!SecurityController::isConnected()) {
                    throw new Exception('Vous devez être connecté pour poster un commentaire.');
                } else {
                    if (isset($_POST['submit_comment'])) {
                        if (!empty($_POST['comment_pseudo']) && !empty($_POST['message'])) {
                            $comment_pseudo = htmlspecialchars($_POST['comment_pseudo']);
                            $message = htmlspecialchars($_POST['message']);
                            if ($comment_pseudo === $_SESSION['pseudo']) {
                                $commentsController->postComment($comment_pseudo, $message);
                            }else {
                                throw new Exception('Le pseudo ne correspond pas à celui de votre profil.');
                            }
                        }else {
                            throw new Exception('Veuillez remplir tous les champs.');
                        }
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require 'view/pages/commentsView.php';
            }
            break;
        case 'delete-comment':
            try {
                if (isset($_POST['delete_comment'])) {
                    $comment_id = htmlspecialchars($_POST['id_comment']);

                    if ($commentsController->getUserCommentsExist($comment_id) || $_SESSION['role'] == 1) {
                        $commentsController->deleteComment($comment_id);
                    }else {
                        throw new Exception('Ce commentaire n\'existe pas ou n\'est pas le vôtre.');
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require 'view/pages/commentsView.php';
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
            throw new Exception($errorMessage('Page introuvable.'));
    }
}catch (Exception $e) {
    $errorMessage = $e->getMessage();
}
