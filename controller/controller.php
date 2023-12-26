<?php

require 'model/UserManager.php';

class UserController
{
    /**
     * @throws Exception
     */
    public function addUser($pseudo, $email, $password): void
    {
        $userManager = new UserManager();
        $affectedLines = $userManager->addUser($pseudo, $email, $password);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter l\'utilisateur !');
        } else {
            header('Location: accueil');
        }
    }

    /**
     * @throws Exception
     */
    public function getUser($pseudo, $password, $email): void
    {
        $userManager = new UserManager();
        $user = $userManager->getUser($pseudo, $password, $email);
        if ($user === false) {
            throw new Exception('Impossible de trouver l\'utilisateur !');
        } else {
            header('Location: accueil');
        }
    }
}