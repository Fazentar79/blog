<?php

require_once 'model/UserManager.php';

class UserController
{
    /**
     * @throws Exception
     */
    public function validationConnection($pseudo, $password): void
    {
        $userPseudo = (new UserManager)->getUserPseudo($pseudo);

        if ((new UserManager)->isCombinationPassword($pseudo, $password)) {
            $_SESSION['pseudo'] = $userPseudo['pseudo'];
        } else {
            throw new Exception('Pseudo ou mot de passe incorrect !');
        }
    }

   public function disconnection(): void
    {
        session_destroy();
        header('Location: accueil');
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
}

class SecurityController
{
    public static function encrypt($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function syntaxeEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }
}
