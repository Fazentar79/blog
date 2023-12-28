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
        require 'view/pages/registrationValidateView.php';
        } else $error = throw new Exception('Impossible d\'ajouter l\'utilisateur !');
    }

    /**
     * @throws Exception
     */
    public function validateRegistration($pseudo, $email, $password): void
    {
        if ($this->userManager->getUserInfo($pseudo, $email, $password) === null) {
            $password = securityController::encrypt($password);
            $this->registerAccount($pseudo, $email, $password);
        }else
            header('Location: inscription');
            $error = throw new Exception('Pseudo, email ou mot de passe déjà pris !');
    }
}

class securityController
{
    public static function encrypt($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
