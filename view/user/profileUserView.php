<?php

global $errorMessage;
$title = "Profil";

ob_start();
?>

<section class="w-100">

    <section class="container">

        <div class="d-flex flex-column">

            <p class="fs-5 text-center text-danger">
                <?php
                echo $errorMessage;
                ?>
            </p>

            <h1 class="text-center mb-5">Profil</h1>

            <h3 class="mt-5 mb-5 text-center">Informations du compte :</h3>

            <div class="d-block m-auto mt-5 mb-5">

                <span class="fw-bold">Pseudo :</span> <?= $_SESSION['pseudo'] ?> <br>
                <span class="fw-bold">Email :</span> <?= $_SESSION['email'] ?> <br>

                <a href="logout" class="text-decoration-none text-center">
                    <button class="btn btn-outline-secondary mt-5"> Se déconnecter</button>
                </a>

                <button type="button" class="btn btn-outline-danger mt-5" data-bs-toggle="modal" data-bs-target="#suppress_account">
                    Supprimer le compte
                </button>

            </div>

            <!-- Modal to delete account -->
            <div class="modal fade" id="suppress_account" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Supprimer le compte ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                <span class="visually-hidden">Fermer</span>
                            </button>
                        </div>


                        <div class="modal-body">
                            <p class="m-0">Est-tu sûr de vouloir supprimer le compte ?</p>
                        </div>

                        <div class="modal-footer">
                            <a href="suppress-account" class="text-decoration-none text-center">
                                <button type="button" class="btn btn-outline-danger">Supprimer le compte</button>
                            </a>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</section>

<?php
$content = ob_get_clean();

require_once "view/template/base.php";
?>