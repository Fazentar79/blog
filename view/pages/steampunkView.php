<?php

$title = "Univers | Steampunk";

ob_start();
?>

<section>
    <h1 class="mt-5 text-center">Steampunk Fantasy</h1>
    <section class="container">
        <div class="row row-cols-2 mt-5 g-2">
            <div class="col">
                <a href="../../public/assets/image/steampunkFantasy/steampunkFantasy01.jpg" target="_blank"><img src="../../public/assets/image/steampunkFantasy/steampunkFantasy01.jpg"
                                                                                                                     alt="photo de steampunk fantasy" class="card-img h-100 opacity"></a>
            </div>
            <div class="col">
                <a href="../../public/assets/image/steampunkFantasy/steampunkFantasy02.jpg" target="_blank"><img src="../../public/assets/image/steampunkFantasy/steampunkFantasy02.jpg"
                                                                                                                     alt="photo de steampunk fantasy" class="card-img h-100 opacity"></a>
            </div>
            <div class="col">
                <a href="../../public/assets/image/steampunkFantasy/steampunkFantasy03.jpg" target="_blank"><img src="../../public/assets/image/steampunkFantasy/steampunkFantasy03.jpg"
                                                                                                                     alt="photo de steampunk fantasy" class="card-img h-100 opacity"></a>
            </div>
            <div class="col">
                <a href="../../public/assets/image/steampunkFantasy/steampunkFantasy04.jpg" target="_blank"><img src="../../public/assets/image/steampunkFantasy/steampunkFantasy04.jpg"
                                                                                                                     alt="photo de steampunk fantasy" class="card-img h-100 opacity"></a>
            </div>
        </div>
    </section>
</section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>