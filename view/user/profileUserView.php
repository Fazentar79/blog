<?php

global $errorMessage;
$title = "Profil";

ob_start();
?>

<section class="w-100 mt-5">
    <h1 class="text-center">Profil</h1>
    <section class="container">
        <p class="fs-5 text-center text-danger">
            <?php
            echo $errorMessage;
            ?>
        </p>
        <p>
            <?php

            try {
                $userController = new UserController();
                $user = $userController->getUser();
                echo 'Pseudo : ' . $_SESSION['pseudo'] . '<br>';
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            ?>
        </p>

        <button>
            <a href="logout">Déconnexion</a>
        </button>
    </section>
</section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>