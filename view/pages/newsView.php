<?php

global $errorMessage;
$title = "News";

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
                $userController = new UserController();

                if (SecurityController::isConnected()) {
                    foreach ($comments as $comment) { ?>

                    <div class="mt-5 d-flex flex-column flex-md-row justify-content-md-center justify-content-between">
                        <p class="bg-tertiary p-3 w-50">
                            <span class="fw-bold"> <?= $_SESSION['pseudo'] ?> </span> : <br>
                            <?= $comment['content'] ?> <br>
                            <?= $comment['date_creation'] ?> <br>
                        </p>
                    </div>
            <?php }

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