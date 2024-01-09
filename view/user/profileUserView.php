<?php


$title = "Connexion";

ob_start();
?>

<section>
    <p>
        <?php
        if (isset($_SESSION['pseudo'])) {
            echo "Bonjour " . $_SESSION['pseudo'] . " !";
        }
        ?>
    </p>
</section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>