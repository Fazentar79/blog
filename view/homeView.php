<!DOCTYPE html>
<html lang="en">

<?php

$title = "Accueil";

ob_start();
?>
<section id="home__content">
    <section id="home__intro" class="w-100 pt-5">
        <h1 class="text-center">Bienvenue sur mon blog !</h1>

        <p class="fs-4 m-5 p-5">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Et ea quibusdam veniam dolorem! Asperiores maiores aliquid exercitationem,
            labore voluptates distinctio, dolore ut temporibus debitis
            explicabo nihil repellat aut hic totam?
        </p>
    </section>
    <section class="mt-5">
        <div class="d-flex flex-column flex-md-row justify-content-between">
            <div id="home__news" class="w-50">
                <h2 class="fw-bold">Les dernières news :</h2>
                <p class="bg-tertiary p-3">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quasi, eius temporibus aspernatur
                    minus, ullam facilis delectus iste repellat iure quam accusamus qui officia maxime rem
                    aliquam
                    nostrum impedit! Asperiores, deserunt!
                </p>
            </div>
            <div id="home__comments" class="w-25">
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

<?php
$content = ob_get_clean();

require_once "base.php";
?>