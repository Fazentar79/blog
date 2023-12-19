<?php

require 'vendor/autoload.php';
require 'App/controller/controller.php';

try {
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'home') {
            home();
        }elseif ($_GET['page'] == 'universe') {
            universe();
        }elseif ($_GET['page'] == 'connection') {
            connection();
        }else {
            throw new Exception("La page demandée n'existe pas.");
        }
    } else {
        home();
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    require 'view/errorView.php';
}
