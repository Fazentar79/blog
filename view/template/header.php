<header class="w-100">
    <nav class="d-flex navbar navbar-dark bg-dark navbar-expand-md fs-4" aria-label="" id="menu">
        <div class="container">
            <div id="brand" class="navbar-brand fs-1">
                La fantasy pour tous
                <p class="text-white fs-7">
                    Un site pour les passionnés de l'univers de la fantasy et de son imagerie.
                </p>
            </div>

            <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#toggleMenu">
                <span class="navbar-toggler-icon"></span>
            </div>

            <div class="collapse navbar-collapse justify-content-end" id="toggleMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="accueil" class="nav-link">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="univers" class="nav-link">Univers</a>
                    </li>
                    <li class="nav-item">
                        <a href="commentaires" class="nav-link">Commentaires</a>
                    </li>
                    <li class="nav-item">
                        <a href="connexion" id="connection__btn" class="nav-link">
                            <?php
                            // Change the button if the user is connected or not
                                if (SecurityController::isConnected()) { ?>
                                    <span class="fa-regular fa-user ms-md-3">
                                    </span>
                                    <span class="fs-6">Profil</span>
                                <?php }else { ?>
                                    <span class="fa-regular fa-user ms-md-3">
                                    </span>
                                    <span class="fs-6">Inscription / Connection</span>
                                <?php }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>
