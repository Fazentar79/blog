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

        // Links to site pages
        case 'accueil':
           require_once 'view/pages/homeView.php';
            break;
        case 'commentaires':
            require_once 'view/pages/commentsView.php';
            break;
        case 'univers':
            require_once 'view/pages/universeView.php';
            break;
        case 'connexion':
            if (SecurityController::isConnected()) {
                require_once 'view/user/profileUserView.php';
            }else {
                require_once 'view/user/connectionView.php';
            }
            break;
        case 'inscription':
            require_once 'view/user/registrationView.php';
            break;
        // Link to each gallery
        case 'fantasy':
            require_once 'view/pages/fantasyView.php';
            break;
        case 'dark-fantasy':
            require_once 'view/pages/darkFantasyView.php';
            break;
        case 'steampunk':
            require_once 'view/pages/steampunkView.php';
            break;

        // Registration and login to user account
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
                require_once 'view/user/registrationView.php';
            }
            break;
        case 'validation-inscription':
            require_once 'view/pages/registrationValidateView.php';
            break;
        case 'logout':
            $userController->logout();
            break;
        case 'connection':
            try {
                if (SecurityController::isConnected()) {
                    throw new Exception('Vous êtes déjà connecté.');
                }

                if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $password = htmlspecialchars($_POST['password']);
                    $userController->verificationPseudo($pseudo);
                }else {
                    throw new Exception('Veuillez remplir tous les champs.');
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require_once 'view/user/connectionView.php';
            }
            break;

        // User account management
        case 'profil':
            require_once 'view/user/profileUserView.php';
            break;
        case 'suppress-account':
            try {
                if (SecurityController::isConnected()) {
                    $userController->suppressAccount($_SESSION['pseudo']);
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require_once 'view/user/profileUserView.php';
            }
            break;

        // Managing articles and comments
        case 'add-news':
        try {
            if (isset($_POST['submit_news'])) {
                if (!empty($_POST['news'])) {
                    $news = htmlspecialchars($_POST['news']);
                    if ($_SESSION['role'] === 1) {
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
            require_once 'view/pages/homeView.php';
        }
            break;
        case 'modify-article':
            try {
                if (isset($_POST['modify_article'])) {
                    $article_id = htmlspecialchars($_POST['id_article']);
                    $modify_news = htmlspecialchars($_POST['modify_news']);

                    if ($articlesController->getNewsArticles($article_id) && $_SESSION['role'] === 1) {
                        $articlesController->modifyArticle($article_id, $modify_news);
                    }else {
                        throw new Exception('Cette news n\'existe pas ou une erreur est survenue.');
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require_once 'view/pages/homeView.php';
            }
            break;
        case 'delete-article':
            try {
                if (isset($_POST['delete_article'])) {
                    $article_id = htmlspecialchars($_POST['id_article']);

                    if ($articlesController->getNewsArticles($article_id) && $_SESSION['role'] === 1) {
                        $articlesController->deleteArticle($article_id);
                    }else {
                        throw new Exception('Cette news n\'existe pas ou une erreur est survenue.');
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require_once 'view/pages/homeView.php';
            }
            break;
        case 'add-comment':
            try {
                if (!SecurityController::isConnected()) {
                    throw new Exception('Vous devez être connecté pour poster un commentaire.');
                }

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
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require_once 'view/pages/commentsView.php';
            }
            break;
        case 'modify-comment':
            try {
                if (isset($_POST['modify_comment'])) {
                    $comment_id = htmlspecialchars($_POST['id_comment']);
                    $modify_UserComment = htmlspecialchars($_POST['modify_UserComment']);

                    if ($commentsController->getUserCommentsExist($comment_id) || $_SESSION['role'] === 1) {
                        $commentsController->modifyComment($comment_id, $modify_UserComment);
                    }else {
                        throw new Exception('Ce commentaire n\'existe pas ou n\'est pas le vôtre.');
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require_once 'view/pages/commentsView.php';
            }
            break;
        case 'delete-comment':
            try {
                if (isset($_POST['delete_comment'])) {
                    $comment_id = htmlspecialchars($_POST['id_comment']);

                    if ($commentsController->getUserCommentsExist($comment_id) || $_SESSION['role'] === 1) {
                        $commentsController->deleteComment($comment_id);
                    }else {
                        throw new Exception('Ce commentaire n\'existe pas ou n\'est pas le vôtre.');
                    }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
                require_once 'view/pages/commentsView.php';
            }
            break;

        // Error management
        case 'erreur':
            require_once 'view/pages/errorView.php';
            break;
        default:
            header('Location: erreur');
            throw new Exception('Page introuvable.');
    }
}catch (Exception $e) {
    $errorMessage = $e->getMessage();
}
