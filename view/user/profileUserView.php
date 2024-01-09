<?php


$title = "Profil";

ob_start();
?>

<section class="w-100 mt-5">
    <h1 class="text-center">Profil</h1>
    <section class="container">
        <p>
            <?php

            try {
                while ($user = (new UserController)->getUser()) {
                    if (isset($_SESSION['profile']['pseudo'])) {
                        echo "Bienvenue " . $user['pseudo'] . " !";
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            ?>
        </p>
    </section>
</section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>