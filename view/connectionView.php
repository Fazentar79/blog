<?php

$title = "Connexion";

ob_start();
?>

<section class="d-block m-auto">
    <p class="fs-1 fw-bold text-center mb-5">Connexion</p>
    <p class="mb-5">Veuillez entrer votre email et mot de passe :</p>
    <form action="#" method="post">
        <div>
            <label for="email" class="form-label"></label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="E-mail">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
        </div>
        <button type="submit" class="w-100 btn btn-outline-dark border-black">Se connecter</button>
        <div class="mt-2 text-center">
            Rejoindre l'aventure ?
            <a href="inscription">S'inscrire</a>
        </div>
    </form>
</section>

<?php
$content = ob_get_clean();

require_once "base.php";
?>