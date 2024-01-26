<?php

global $errorMessage;
$title = "Inscription";

ob_start();
?>

    <section class="d-block m-auto">
        <p class="fs-6 text-center text-danger">
            <?php
            echo $errorMessage;
            ?>
        <p> <?php  ?> </p>
        <p class="fs-1 fw-bold text-center mb-5">Inscription</p>
        <p>Veuillez remplir tous les champs :</p>
        <form action="registration" method="post">
            <div>
                <label for="pseudo" class="form-label"></label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo">
            </div>
            <div>
                <label for="email" class="form-label"></label>
                <input type="email" class="form-control" id="email" name="email"
                       aria-describedby="emailHelp" placeholder="E-mail">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            </div>
            <button type="submit" class="w-100 btn btn-outline-dark border-black">Rejoindre l'aventure</button>
            <div class="mt-2 text-center">
                Déjà dans l'aventure ?
                <a href="connexion" class="">Connexion</a>
            </div>
        </form>
    </section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>

