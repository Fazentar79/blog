<?php

require_once 'model/UserManager.php';

class UserController
{
    /**
     * @throws Exception
     */
    public function validationConnection($pseudo, $password): void
    {
        $userManager = new UserManager();

        if (!$userManager->isPasswordValid($pseudo, $password)) {
                $_SESSION['pseudo'] = $pseudo;
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
        unset($_SESSION['pseudo']);
        header('Location: accueil');
        if ($_SESSION['pseudo']) {
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
        return $userManager->getUser();
    }
}

class SecurityController
{
    public static function encrypt($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function secure($string): string
    {
        return htmlspecialchars($string);
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
