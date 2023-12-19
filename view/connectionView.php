<?php

$title = "Connexion";

ob_start();
?>

<section class="d-block m-auto">
    <p class="fs-1 fw-bold text-center mb-5">Connexion</p>
    <p>Veuillez entrer votre email et mot de passe :</p>
    <form action="#" method="post" id="form">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-outline-dark">Se connecter</button>
    </form>
</section>

<?php
$content = ob_get_clean();

require_once "base.php";
?>