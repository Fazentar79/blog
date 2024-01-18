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

    <section class="w-100">
        <?php
            try {

                $commentController = new CommentsController();
                $comments = $commentController->getUserComments();

                if (SecurityController::isConnected()) {
                    foreach ($comments as $comment) { ?>

                        <p class="bg-tertiary p-3 m-5 borderRadius">
                            <span class="fw-bold">
                                <?= $comment['comment_pseudo'] ?>
                            </span> : <br><br>
                            <span class="p-5"><?= $comment['content'] ?></span> <br><br>
                            <?= $comment['date_creation'] ?> <br>

                            <?php

                                try {
                                    if ($_SESSION['pseudo'] == $comment['comment_pseudo'] || $_SESSION['role'] == 1) { ?>
                                        <form action="delete-comment" method="post">
                                            <input type="submit" class="btn btn-outline-danger" name="delete_comment" value="Supprimer le commentaire">
                                            <input type="hidden" name="id_comment" value="<?= $comment['id'] ?>">
                                        </form>
                                    <?php }
                                } catch (Exception $e) {
                                    $errorMessage = $e->getMessage();
                                }
                            }
                }else { ?>
                    <p class="text-center text-danger mt-5">"Vous devez être connecté pour voir les commentaires." </p>
                <?php
                }
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }
        ?>

    </section>

</section>

<?php
$content = ob_get_clean();

require_once 'view/template/base.php';
?>