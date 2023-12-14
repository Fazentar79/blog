<?php

require_once 'model/UserManager.php';

function home()
{
    $userManager = new UserManager();
    $req = $userManager->getUser();

    require 'view/homeView.php';
}
