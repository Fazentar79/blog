<?php

global $errorMessage;
$title = "Accueil";

ob_start();

?>
<section class="container">

    <section class="w-100 pt-5">

        <?php
            if (SecurityController::isConnected()) {
                if ($_SESSION['role'] == 1) { ?>

                    <h1 class="text-center">Gestion des news</h1>

                <?php }else{ ?>

                    <h1 class="text-center fw-bold">Bon retour parmis nous <?= $_SESSION['pseudo'] ?> .</h1>

                    <p class="fs-5 mt-5 p-md-5">
                        N'hésites pas à regarder les dernières news et les nouvelles images. Et donne ton avis dans la section commentaires.
                    </p>
                    <h3 class="text-center">Bienvenue dans l'aventure !</h3>
                <?php }
            }else { ?>

                <h1 class="text-center fw-bold">Bienvenue sur mon blog !</h1>

                <p class="fs-5 mt-5 p-md-5">
                    Vous trouverez ici des images sur les différents univers de la Fantasy.
                    Vous pouvez vous inscrire pour donner votre avis ou voir la gallerie d'image. <br>
                </p>

            <?php }
        ?>

    </section>

    <section class="mt-5">

        <section class="text-center text-danger">

            <p>
                <?php
                echo $errorMessage;
                ?>
            </p>

        </section>

        <div class="d-flex flex-column flex-md-row justify-content-md-center justify-content-between">

            <div class="w-100">
                <h2 class="text-center my-5 fw-bold">Les dernières news :</h2>

                <?php

                    try {
                        $articlesController = new ArticlesController();
                        $articles = $articlesController->getArticles();

                        foreach ($articles as $article) { ?>
                            <p class="bg-tertiary p-3 border_radius">
                                <span class="p-5"><?= $article['content'] ?></span> <br><br>
                                <?= $article['date_creation'] ?> <br>
                                <?php
                            if (SecurityController::isConnected()) { ?>
                                <?php if ($_SESSION['role'] == 1) { ?>
                                    <div class="d-flex mb-5 justify-content-md-start justify-content-between">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modify">
                                            Modifier la news
                                        </button>
                                        <button type="button" class="btn btn-outline-danger ms-3" data-bs-toggle="modal" data-bs-target="#suppress_news">
                                            Supprimer la news
                                        </button>
                                    </div>

                                    <!-- Modal pour modifier les news -->
                                    <div class="modal fade" id="modify" data-bs-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier la news ?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        <span class="visually-hidden">Fermer</span>
                                                    </button>
                                                </div>
                                                <form action="modify-article" method="post">
                                                    <div class="modal-body">
                                                        <label for="modify_news" class="form-label"></label>
                                                        <textarea class="form-control" id="modify_news" name="modify_news" rows="3" placeholder="Modifier la news"></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-outline-secondary" name="modify_article" value="Modifier">
                                                        <input type="hidden" name="id_article" value="<?= $article['id'] ?>">

                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal pour supprimer les news -->
                                    <div class="modal fade" id="suppress_news" data-bs-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered">

                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"> Supprimer la news ?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        <span class="visually-hidden">Fermer</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <p class="m-0">Supprimer la news définitivement ?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <form action="delete-article" method="post" class="my-3 ms-md-5">
                                                        <input type="submit" class="btn btn-outline-danger" name="delete_article" value="Supprimer la news">
                                                        <input type="hidden" name="id_article" value="<?= $article['id'] ?>">
                                                    </form>
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php }
                            }
                        }
                    }catch (Exception $e) {
                        $errorMessage = $e->getMessage();
                    }
                ?>
            </div>
        </div>

    </section>

    <section class="mt-5">

        <?php
            try {
                if (SecurityController::isConnected()) {
                    if ($_SESSION['role'] == 1) {
                        ?>
                        <div>
                            <form action="add-news" method="post">
                                <div class="mb-3">
                                    <label for="news" class="form-label"></label>
                                    <textarea class="form-control" id="news" name="news" rows="3" placeholder="News"></textarea>
                                </div>
                                <input type="submit" class="btn btn-outline-secondary" name="submit_news" value="Publier">
                                <input type="hidden" name="action" value="add-news">
                            </form>
                        </div>
                    <?php }
                }
            }catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }
        ?>

    </section>

</section>

<?php
$content = ob_get_clean();

require_once 'view/template/base.php';
?>