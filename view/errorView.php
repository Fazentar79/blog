<?php

$title = "Page inexistante";

ob_start();
?>

<section class="container">
    <h1>Erreur.</h1>
    <p>La page que vous recherchez n'existe pas.</p>
    </div>
</section>

<?php

$content = ob_get_clean();

require_once "view/base.php";
?>