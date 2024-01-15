<?php

$title = "Accueil";

ob_start();

?>
<section>

    <section class="w-100 pt-5">
        <h1 class="text-center">Bienvenue sur mon blog !</h1>

        <p class="fs-4 m-5 p-md-5-5">
           Vous trouverez ici des images sur les différents univers de la Fantasy
           Vous pouvez vous inscrire pour pouvoir commenter les news et donner votre avis
           Bienvenue dans l'aventure !
        </p>
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
            <div class="home__content me-md-5 me-sm-0">
                <h2 class="fw-bold">Derniers commentaires :</h2>
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