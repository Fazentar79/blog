<?php

require 'controller/controller.php';

try {
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'home') {
            home();
        } else {
            throw new Exception("La page demandée n'existe pas.");
        }
    } else {
        home();
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    require 'view/errorView.php';
}
