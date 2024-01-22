<?php

global $errorMessage;
$title = "Commentaires";

ob_start();

?>
<section class="container">

    <section class="text-center text-danger w-100">

        <p>
            <?php
            echo $errorMessage;
            ?>
        </p>

    </section>

        <section class="text-center w-100">
            <?php
                // Form to add a comment (if the user is logged in)
                if (SecurityController::isConnected()) {
                    if ($_SESSION['role'] == 1) { ?>

                            <h1 class="text-center">Gestion des commentaires</h1>

                    <?php }else{ ?>

                            <h1 class="mb-5">Commentaires</h1>
                            <p>Ajouter un commentaire :</p>

                        <section class="w-50 d-block m-auto">

                                <form action="add-comment" method="post">
                                    <div>
                                        <label for="comment_pseudo" class="form-label"></label>
                                        <input type="text" class="form-control" id="comment_pseudo" name="comment_pseudo" aria-describedby="emailHelp" placeholder="Pseudo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label"></label>
                                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Commentaire"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-outline-secondary" name="submit_comment">Publier</button>
                                </form>

                        </section>
                    <?php }
                } ?>
        </section>

    <section>
        <div>
            <?php
                /* Viewing comments (if user is logged in)
                 and buttons to edit or delete comments
                 (if the user is logged in and the comment belongs to them or they are admin) */
                try {

                    $commentController = new CommentsController();
                    $comments = $commentController->getUserComments();

                    if (SecurityController::isConnected()) {
                        foreach ($comments as $comment) {
                             ?>
                                <p class="bg-tertiary p-3 mt-5 border_radius">
                                <span class="fw-bold">
                                    <?= $comment['comment_pseudo'] ?>
                                </span> : <br><br>
                                <span class="p-5"><?= $comment['content'] ?></span> <br><br>
                                <?= $comment['date_creation'] ?> <br>
                                <?php

                                    if ($_SESSION['pseudo'] == $comment['comment_pseudo'] || $_SESSION['role'] == 1) { ?>
                                        <div class="d-flex justify-content-md-start justify-content-between">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modify_comment">
                                                Modifier le commentaire
                                            </button>
                                            <button type="button" class="btn btn-outline-danger ms-3" data-bs-toggle="modal" data-bs-target="#suppress_comment">
                                                Supprimer le commentaire
                                            </button>
                                        </div>

                                            <!-- Modal to edit comments -->
                                            <div class="modal fade" id="modify_comment" data-bs-backdrop="static">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Modifier le commentaire ?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                <span class="visually-hidden">Fermer</span>
                                                            </button>
                                                        </div>
                                                        <form action="modify-comment" method="post">
                                                            <div class="modal-body">
                                                                <label for="modify_UserComment" class="form-label"></label>
                                                                <textarea class="form-control" id="modify_UserComment" name="modify_UserComment" rows="3" placeholder="Modifier le commentaire"></textarea>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-outline-secondary" name="modify_comment" value="Modifier">
                                                                <input type="hidden" name="id_comment" value="<?= $comment['id'] ?>">

                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal to delete comments -->
                                            <div class="modal fade" id="suppress_comment" data-bs-backdrop="static">
                                                <div class="modal-dialog modal-dialog-centered">

                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Supprimer le commentaire ?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                <span class="visually-hidden">Fermer</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <p class="m-0"> Etes-vous sûr de vous de vouloir supprimer le commentaire ?</p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form action="delete-comment" method="post" class="my-3 ms-md-5">
                                                                <input type="submit" class="btn btn-outline-danger" name="delete_comment" value="Supprimer le commentaire">
                                                                <input type="hidden" name="id_comment" value="<?= $comment['id'] ?>">
                                                            </form>
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                    }else { ?>
                        <!-- Show this message if the user is not logged in -->
                        <p class="mt-5">Tu dois être connecté pour accéder à cette page. <br><br>
                            Si tu n'as pas de compte ou que tu as oublié de te connecter, clic sur le lien ci-dessous :</p><br>

                        <a href="connexion" class="p-5">
                            <button class="btn btn-outline-secondary border-black">
                                Connection/Inscription
                            </button>
                        </a>

                    <?php
                    }
                } catch (Exception $e) {
                    $errorMessage = $e->getMessage();
                }
            ?>
        </div>
    </section>

</section>

<?php
$content = ob_get_clean();

require_once 'view/template/base.php';
?>