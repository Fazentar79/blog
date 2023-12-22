<?php

require 'vendor/autoload.php';
require 'App/controller/controller.php';

try {
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'accueil') {
            require 'view/homeView.php';
        }elseif ($_GET['page'] == 'univers') {
            require 'view/universeView.php';
        }elseif ($_GET['page'] == 'connexion') {
            require 'view/connectionView.php';
        }elseif ($_GET['page'] == 'inscription') {
            require 'view/inscriptionView.php';
        }elseif ($_GET['page'] == 'fantasy') {
            require 'view/fantasyView.php';
        }elseif ($_GET['page'] == 'dark-fantasy') {
            require 'view/darkFantasyView.php';
        }elseif ($_GET['page'] == 'steampunk') {
            require 'view/steampunkView.php';
        }        else {
            throw new Exception("La page demandée n'existe pas.");
        }
    } else {
        require 'view/homeView.php';
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    require 'view/errorView.php';
}
