<?php

$title = "Univers | Fantasy";

ob_start();
?>

    <section>
        <h1 class="mt-5 text-center">Fantasy</h1>
        <section class="container">
            <div class="row row-cols-2 mt-5 g-2">
                <div class="col">
                    <a href="../../public/assets/image/fantasy/fantasy02.jpg" target="_blank">
                        <img src="../../public/assets/image/fantasy/fantasy02.jpg"
                            alt="photo de fantasy" class="card-img h-100 opacity"></a>
                </div>
                <div class="col">
                    <a href="../../public/assets/image/fantasy/fantasy03.jpg" target="_blank">
                        <img src="../../public/assets/image/fantasy/fantasy03.jpg"
                            alt="photo de fantasy" class="card-img h-100 opacity"></a>
                </div>
                <div class="col">
                    <a href="../../public/assets/image/fantasy/fantasy04.png" target="_blank">
                        <img src="../../public/assets/image/fantasy/fantasy04.png"
                            alt="photo de fantasy" class="card-img h-100 opacity"></a>
                </div>
                <div class="col">
                    <a href="../../public/assets/image/fantasy/fantasy05.jpg" target="_blank">
                        <img src="../../public/assets/image/fantasy/fantasy05.jpg"
                            alt="photo de fantasy" class="card-img h-100 opacity"></a>
                </div>
                <div class="col">
                    <a href="../../public/assets/image/fantasy/fantasy06.jpg" target="_blank">
                        <img src="../../public/assets/image/fantasy/fantasy06.jpg"
                            alt="photo de fantasy" class="card-img h-100 opacity"></a>
                </div>
            </div>
        </section>
    </section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>

