<?php
global $errorMessage;
$title = "Validation de l'inscription";

ob_start();
?>

    <section class="d-block m-auto">
        <p class="fs-5 text-center text-danger">
            <?php
            echo $errorMessage;
            ?>
        </p>
        <p class="fs-1 fw-bold text-center mb-5">Vous voilà dans l'aventure !</p>
        <p class="mb-5">Se <a href="connexion">connecter</a> ? Ou retourner à l' <a href="accueil">accueil</a>.</p>
    </section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>

