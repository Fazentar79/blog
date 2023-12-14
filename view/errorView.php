<?php

$title = "Page inexistante";

ob_start();
?>

<section class="container p-5">
    <p class="fs-2">Erreur.</p>
    <p>La page que vous recherchez n'existe pas.</p>
    </div>
</section>

<?php

$content = ob_get_clean();

require_once "view/base.php";
?>