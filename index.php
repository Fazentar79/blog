<?php

require 'vendor/autoload.php';
require 'App/controller/controller.php';

try {
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'home') {
            require 'view/homeView.php';
        }elseif ($_GET['page'] == 'universe') {
            require 'view/universeView.php';
        }elseif ($_GET['page'] == 'contact') {
            require 'view/contactView.php';
        }elseif ($_GET['page'] == 'connection') {
            require 'view/connectionView.php';
        }else {
            throw new Exception("La page demandée n'existe pas.");
        }
    } else {
        require 'view/homeView.php';
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    require 'view/errorView.php';
}
