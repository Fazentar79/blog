<?php

require_once 'model/UserManager.php';
require_once 'model/CommentsManager.php';
require_once 'model/ArticlesManager.php';

class UserController
{
    public $userManager;
    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    /**
     * @throws Exception
     */
    public function validationConnection($pseudo): void
    {
        if ($this->userManager->getUserPassword($pseudo)) {

            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['email'] = $this->userManager->getUserEmail($pseudo);
            $_SESSION['role'] = $this->userManager->getUserAdmin($pseudo);
            header('Location: accueil');
        } else {
            throw new Exception('Pseudo ou mot de passe incorrect.');
        }
    }

    /**
     * @throws Exception
     */
    public function verificationPseudo($pseudo): void
    {
        if (!$this->userManager->getUserPseudo()) {
            $this->validationConnection($pseudo);
        }
    }

    /**
     * @throws Exception
     */
    public function logout(): void
    {
        unset($_SESSION['pseudo']);

        if ($_SESSION['pseudo']) {
            throw new Exception('Erreur lors de la déconnexion.');
        }else {
            header('Location: connexion');
            throw new Exception('Vous êtes déconnecté.');
        }
    }

    /**
     * @throws Exception
     */
    private function registerAccount($pseudo, $email, $password): void
    {
        if (!$this->userManager->addUser($pseudo, $email, $password)) {
            throw new Exception('Erreur lors de l\'inscription.');
        } else {
            header('Location: validation-inscription');
            exit();
        }
    }

    /**
     * @throws Exception
     */
    public function registerVerification($pseudo, $email, $password): void
    {
        if (SecurityController::syntaxeEmail($email) === true) {
            if (!$this->userManager->getCheckUserEmail($email)) {
                $this->registerAccount($pseudo, $email, $password);
            } else {
                throw new Exception('Pseudo, email ou password déjà utilisé.');
            }
        } else {
            throw new Exception('Email invalide !');
        }
    }

    /**
     * @throws Exception
     */
    public function suppressAccount($pseudo): void
    {
        if (!$this->userManager->deleteUser($pseudo)) {
            throw new Exception('Erreur lors de la suppression du compte.');
        } else {
            unset($_SESSION['pseudo']);
            unset($_SESSION['email']);
            header('Location: connexion');
            throw new Exception('Votre compte a bien été supprimé.');
        }
    }
}

class CommentsController
{
    public $commentsManager;

    public function __construct()
    {
        $this->commentsManager = new CommentsManager();
    }
    /**
     * @throws Exception
     */

    /**
     * @throws Exception
     */
    public function getUserComments(): PDOStatement
    {
        return $this->commentsManager->getComments();
    }

    /**
     * @throws Exception
     */
    public function getUserCommentsExist($id): bool
    {
        return $this->commentsManager->getUserComments($id);
    }

    /**
     * @throws Exception
     */
    public function postComment($comment_pseudo, $message): void
    {
        $result = $this->commentsManager->postComment($comment_pseudo, $message);

        if (!$result) {
            throw new Exception('Erreur lors de l\'ajout du commentaire.');
        } else {
            header('Location: commentaires');
            exit();
        }
    }

    /**
     * @throws Exception
     */
    public function deleteComment($id): void
    {
        $result = $this->commentsManager->deleteComment($id);

        if (!$result) {
            throw new Exception('Erreur lors de la suppression du commentaire.');
        } else {
            header('Location: commentaires');
            exit();
        }
    }
}

class ArticlesController
{
    public $articlesManager;

    public function __construct()
    {
        $this->articlesManager = new ArticlesManager();
    }

    /**
     * @throws Exception
     */

    public function getArticles(): PDOStatement
    {
        return $this->articlesManager->getArticles();
    }

    /**
     * @throws Exception
     */
    public function getNewsArticles($id): bool
    {
        return $this->articlesManager->getNewsArticles($id);
    }

    /**
     * @throws Exception
     */
    public function addArticle($news): void
    {
        $result = $this->articlesManager->addArticle($news);

        if (!$result) {
            throw new Exception('Erreur lors de l\'ajout de l\'article.');
        } else {
            header('Location: accueil');
            exit();
        }
    }

    /**
     * @throws Exception
     */
    public function deleteArticle($id): void
    {
        $result = $this->articlesManager->deleteArticle($id);

        if (!$result) {
            throw new Exception('Erreur lors de la suppression de l\'article.');
        } else {
            header('Location: accueil');
            exit();
        }
    }
}

class SecurityController
{
    public static function encrypt($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function syntaxeEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }

    public static function isConnected(): bool
    {
        return (!empty($_SESSION['pseudo']));
    }
}

