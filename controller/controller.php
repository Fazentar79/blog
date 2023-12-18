<?php

require_once 'model/UserManager.php';

/**
 * @throws Exception
 */
function home(): void
{
    $userManager = new UserManager();
    $req = $userManager->getUser();

    require 'view/homeView.php';
}
