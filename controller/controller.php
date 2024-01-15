<?php

require_once 'model/UserManager.php';
require_once 'model/CommentsManager.php';

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
                header('Location: profil');
            } else {
                throw new Exception('Pseudo ou mot de passe incorrect.');
            }
    }

    /**
     * @throws Exception
     */
    public function verificationPseudo($pseudo): void
    {
        if (!$this->userManager->getUserPseudo($pseudo)) {
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
            if (!$this->userManager->getUserEmail($email)) {
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
    public function getUser(): string
    {
        try {
            return 'Bonjour ' . $_SESSION['pseudo'] . '<br>';
        } catch (Exception $e) {
            echo $e->getMessage();
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
    public function postComment($message): void
    {
        $result = $this->commentsManager->postComment($message);

        if (!$result) {
            throw new Exception('Erreur lors de l\'ajout du commentaire.');
        } else {
            header('Location: commentaires');
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

    public static function isAdmin(): bool
    {
        return (!empty($_SESSION['role'] === 'admin'));
    }
}

