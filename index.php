<?php

require 'vendor/autoload.php';
require 'controller/controller.php';

try {
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'accueil') {
            require 'view/pages/homeView.php';
        }elseif ($_GET['page'] == 'univers') {
            require 'view/pages/universeView.php';
        }elseif ($_GET['page'] == 'connexion') {
            require 'view/user/connectionView.php';
        }elseif ($_GET['page'] == 'inscription') {
            require 'view/user/registrationView.php';
        }elseif ($_GET['page'] == 'fantasy') {
            require 'view/pages/fantasyView.php';
        }elseif ($_GET['page'] == 'dark-fantasy') {
            require 'view/pages/darkFantasyView.php';
        }elseif ($_GET['page'] == 'steampunk') {
            require 'view/pages/steampunkView.php';
        }        else {
            throw new Exception("La page demandée n'existe pas.");
        }
    } else {
        require 'view/pages/homeView.php';
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    require 'view/pages/errorView.php';
}
