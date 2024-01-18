<?php

global $errorMessage;
$title = "Profil";

ob_start();
?>

<section class="w-100">

    <section class="container">

        <div class="d-flex flex-column">

            <p class="fs-5 text-center text-danger">
                <?php
                echo $errorMessage;
                ?>
            </p>

            <h1 class="text-center mb-5">Profil</h1>

            <h3 class="mt-5 mb-5 text-center">Informations du compte :</h3>

            <div class="d-block m-auto mt-5 mb-5">

                <span class="fw-bold">Pseudo :</span> <?= $_SESSION['pseudo'] ?> <br>
                <span class="fw-bold">Email :</span> <?= $_SESSION['email'] ?> <br>

                <a href="logout" class="text-decoration-none text-center">
                    <button class="btn btn-outline-secondary mt-5"> Se déconnecter</button>
                </a>
                <a href="suppress-account" class="text-decoration-none text-center">
                    <button class="btn btn-outline-danger mt-5"> Supprimer le compte</button>
                </a>

            </div>

        </div>

    </section>

</section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>