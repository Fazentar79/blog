<?php

require_once 'model/UserManager.php';

class UserController
{
    public UserManager $userManager;
    public function __construct()
    {
        $this->userManager = new UserManager();
    }
    /**
     * @throws Exception
     */
    private function registerAccount($pseudo, $email, $password): void
    {
        if ($this->userManager->addUser($pseudo, $email, $password)) {
            header('Location: validation-inscription');
        } else {
            header('Location: erreur');
            ErrorController::error('Erreur lors de l\'inscription !');
        }
    }

    /**
     * @throws Exception
     */
    public function validateRegistration($pseudo, $email, $password): void
    {
        if ($this->userManager->isPseudoFree($pseudo)) {
            $password = securityController::encrypt($password);
            $email = securityController::checkEmail($email);
            $this->registerAccount($pseudo, $email, $password);
        }else
            header('Location: erreur');
            ErrorController::error('Pseudo, email ou mot de passe déjà utilisé !');
    }
}

class securityController
{
    public static function encrypt($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

class ErrorController
{
    /**
     * @throws Exception
     */
    public static function error($error): void
    {
        $errorMessage = throw new Exception('Erreur : ' . $error);
    }
}