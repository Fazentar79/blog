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
        <?php
            if (SecurityController::isConnected()) { ?>
                <section class="text-center w-100">

                    <h1 class="mb-5">Commentaires</h1>
                    <p>Ajouter un commentaire :</p>

                </section>

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
        <?php } ?>
    <section>
        <div>
            <?php
                try {

                    $commentController = new CommentsController();
                    $comments = $commentController->getUserComments();

                    if (SecurityController::isConnected()) {
                        foreach ($comments as $comment) { ?>

                            <p class="bg-tertiary p-3 mt-5 border_radius">
                                <span class="fw-bold">
                                    <?= $comment['comment_pseudo'] ?>
                                </span> : <br><br>
                                <span class="p-5"><?= $comment['content'] ?></span> <br><br>
                                <?= $comment['date_creation'] ?> <br>
                                <?php
                                    if ($_SESSION['pseudo'] == $comment['comment_pseudo'] || $_SESSION['role'] == 1) { ?>
                                        <div class="d-flex justify-content-md-start justify-content-between">
                                            <form action="modify-comment" method="post">
                                                <input type="submit" class="btn btn-outline-secondary" name="modify_comment" value="Modifier le commentaire">
                                                <input type="hidden" name="id_comment" value="<?= $comment['id'] ?>">
                                            </form>
                                            <form action="delete-comment" method="post" class="ms-md-5">
                                                <input type="submit" class="btn btn-outline-danger" name="delete_comment" value="Supprimer le commentaire">
                                                <input type="hidden" name="id_comment" value="<?= $comment['id'] ?>">
                                            </form>
                                        </div>
                                    <?php }
                                }
                    }else { ?>

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