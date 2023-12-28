<?php


$title = "Erreur";

ob_start();
?>

<section class="container p-5">
    <p class="fs-2"></p>

</section>

<?php

$content = ob_get_clean();

require_once "view/template/base.php";
?>