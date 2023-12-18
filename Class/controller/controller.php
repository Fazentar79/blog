<?php

require_once 'Class/model/UserManager.php';

/**
 * @throws Exception
 */
function home(): void
{
    $userManager = new UserManager();
    $req = $userManager->getUser();

    require 'view/homeView.php';
}
