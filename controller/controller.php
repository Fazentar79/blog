<?php

require_once 'model/UserManager.php';

class UserController
{
    /**
     * @throws Exception
     */
    public function validationConnection($pseudo, $password): void
    {
        if ((new UserManager)->isCombinationPassword($pseudo, $password)) {
            $_SESSION['profile']['pseudo'] = $pseudo;
            header('Location: profil');
        } else {
            throw new Exception('Pseudo ou mot de passe incorrect !');
        }
    }

    /**
     * @throws Exception
     */
    public function logout(): void
    {
        unset($_SESSION['profile']);
        header('Location: accueil');
        if ($_SESSION['profile']) {
            throw new Exception('Erreur lors de la déconnexion !');
        }else {
            throw new Exception('Vous êtes déconnecté !');
        }
    }

    /**
     * @throws Exception
     */
    private function registerAccount($pseudo, $email, $password): void
    {
        if (!(new UserManager)->addUser($pseudo, $email, $password)) {
            throw new Exception('Erreur lors de l\'inscription !');
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
            if (!(new UserManager)->getUserEmail($email)) {
                $password = SecurityController::encrypt($password);
                $this->registerAccount($pseudo, $email, $password);
            } else {
                throw new Exception('Pseudo, email ou password déjà utilisé !');
            }
        } else {
            throw new Exception('Email invalide !');
        }
    }

    /**
     * @throws Exception
     */
    public function getUser(): false|array
    {
        $userManager = new UserManager();
        $request = $userManager->getUser();
    }
}

class SecurityController
{
    public static function encrypt($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function secure($string): string
    {
        return htmlentities($string);
    }

    public static function syntaxeEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }

    public static function isConnected(): bool
    {
        return (!empty($_SESSION['profile']['pseudo']));
    }

    public static function isAdmin(): bool
    {
        return (!empty($_SESSION['profile']['role'] === 'admin'));
    }
}
