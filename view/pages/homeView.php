<?php

global $errorMessage;
$title = "Accueil";

ob_start();

?>
<section class="container">

    <section class="w-100 pt-5">

        <?php

            if (SecurityController::isConnected()) { ?>
                <h1 class="text-center fw-bold">Bon retour parmis nous <?= $_SESSION['pseudo'] ?> .</h1>

                <p class="fs-5 mt-5 p-md-5">
                    N'hésites pas à regarder les dernières news et les nouvelles images. Et donne ton avis dans la section commentaires.
                </p>

            <?php }else { ?>
                <h1 class="text-center fw-bold">Bienvenue sur mon blog !</h1>

                <p class="fs-5 mt-5 p-md-5">
                    Vous trouverez ici des images sur les différents univers de la Fantasy.
                    Vous pouvez vous inscrire pour donner votre avis. <br>
                </p>
                <h3 class="text-center">Bienvenue dans l'aventure !</h3>

            <?php }

        ?>

    </section>

    <section class="mt-5">

        <div class="d-flex flex-column flex-md-row justify-content-md-center justify-content-between">



                <section class="text-center text-danger">

                    <p>
                        <?php
                        echo $errorMessage;
                        ?>
                    </p>

                </section>

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
                                    <form action="delete-article" method="post" class="mt-3 mb-3">
                                        <input type="submit" class="btn btn-outline-danger" name="delete_article" value="Supprimer la news">
                                        <input type="hidden" name="id_article" value="<?= $article['id'] ?>">
                                    </form>
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