<?php

$title = "Univers | Steampunk Fantasy";

ob_start();
?>

<section>
    <h1 class="mt-5 text-center">Dark Fantasy</h1>
    <section class="container">
        <div class="row row-cols-2 g-2">
            <div class="col">
                <img src="../../public/assets/image/darkFantasy/darkFantasy01.jpg" alt="photo de dark fantasy" class="card-img h-100">
            </div>
            <div class="col">
                <img src="../../public/assets/image/darkFantasy/darkFantasy03.jpg" alt="photo de dark fantasy" class="card-img h-100">
            </div>
            <div class="col">
                <img src="../../public/assets/image/darkFantasy/darkFantasy03.jpg" alt="photo de dark fantasy" class="card-img h-100">
            </div>
            <div class="col">
                <img src="../../public/assets/image/darkFantasy/darkFantasy04.jpg" alt="photo de dark fantasy" class="card-img h-100">
            </div>
            <div class="col">
                <img src="../../public/assets/image/darkFantasy/darkFantasy05.jpg" alt="photo de dark fantasy" class="card-img h-100">
            </div>
            <div class="col">
                <img src="../../public/assets/image/darkFantasy/darkFantasy06.jpg" alt="photo de dark fantasy" class="card-img h-100">
            </div>
        </div>
    </section>
</section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>