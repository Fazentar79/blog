<?php

$title = "Univers";

ob_start();
?>

<section>
    <h1 class="mt-5 text-center">Quel univers choisirez-vous ?</h1>
    <section class="container">
        <div class="mt-5 mb-5 d-flex flex-lg-row flex-column">
            <div class="p-0 card">
                <a href="fantasy"><img src="../public/assets/image/fantasy/fantasy02.jpg"
                                       alt="photo de fantasy" class="card-img h-100"></a>
                <div class="card-header text-center">
                    Fantasy
                </div>
                <div class="card-body">
                    <p class="card-text">La fantasy est un genre littéraire présentant un ou plusieurs éléments surnaturels
                        qui relèvent souvent du mythe et qui sont souvent incarnés par des créatures,
                        des personnages ou des phénomènes surnaturels.</p>
                    </div>
            </div>
            <div class="p-0 card mx-lg-3">
                <a href="dark-fantasy"><img src="../public/assets/image/darkFantasy/darkFantasy06.jpg"
                                           alt="photo de dark fantasy" class="card-img h-100"></a>
                <div class="card-header text-center">
                    Dark Fantasy
                </div>
                <div class="card-body">
                    <p class="card-text">La dark fantasy est un sous-genre de la fantasy qui se caractérise par une
                        atmosphère plus sombre, plus violente et plus adulte que la fantasy traditionnelle.</p>
                </div>
            </div>
            <div class="p-0 card">
                <a href="steampunk"><img src="../public/assets/image/steampunkFantasy/steampunkFantasy03.jpg"
                                         alt="photo de steampunk fantasy" class="card-img h-100"></a>
                <div class="card-header text-center">
                    Steampunk Fantasy
                </div>
                <div class="card-body">
                    <p class="card-text">Le steampunk est un genre de fantasy qui mêle des éléments du roman policier et de
                        la science-fiction, ainsi que des aspects de la fantasy.</p>
            </div>
        </div>
    </section>
</section>

<?php
$content = ob_get_clean();

require_once "base.php";
?>