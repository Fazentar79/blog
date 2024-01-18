<?php

$title = "Accueil";

ob_start();

?>
<section>

    <section class="w-100 pt-5">

        <?php

            if (SecurityController::isConnected()) { ?>
                <h1 class="text-center">Bon retour parmis nous <?= $_SESSION['pseudo'] ?> .</h1>

                <p class="fs-4 mt-5 p-md-5">
                    N'hésite pas à regarder les dernières news et les nouvelles images. Et donnes ton avis dans la section commentaires.
                </p>

            <?php }else { ?>
                <h1 class="text-center">Bienvenue sur mon blog !</h1>

                <p class="fs-4 mt-5 p-md-5">
                    Vous trouverez ici des images sur les différents univers de la Fantasy.
                    Vous pouvez vous inscrire pour donner votre avis. <br>
                </p>
                <h3 class="text-center">Bienvenue dans l'aventure !</h3>

            <?php }

        ?>

    </section>

    <section class="mt-5">

        <div class="d-flex flex-column flex-md-row justify-content-md-center justify-content-between">

            <div class="home__content me-md-5">

                <h2 class="fw-bold">Les dernières news :</h2>

                <p class="bg-tertiary p-3">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quasi, eius temporibus aspernatur
                    minus, ullam facilis delectus iste repellat iure quam accusamus qui officia maxime rem
                    aliquam
                    nostrum impedit! Asperiores, deserunt!
                </p>

            </div>

        </div>

    </section>

</section>

<?php
$content = ob_get_clean();

require_once 'view/template/base.php';
?>