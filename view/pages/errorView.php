<?php

global $errorMessage;
$title = "Erreur";

ob_start();
?>

<section class="container p-5">
    <p class="fs-2">
        <?php
        echo $errorMessage;
        ?>
    </p>

</section>

<?php

$content = ob_get_clean();

require_once "view/template/base.php";
?>