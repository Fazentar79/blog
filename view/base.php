<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../public/design/css/base.css">
    <title>
        <?= $title ?>
    </title>
</head>

<body class="d-flex flex-column min-vh-100" data-bs-spy="scroll" data-bs-target="#menu">

    <header>
        <nav class="d-flex navbar navbar-dark bg-dark navbar-expand-md fs-4" aria-label="" id="menu">
            <div class="container">
                <div id="brand" class="navbar-brand fs-1">
                    Les Eternels Compagnons
                    <p class="text-white fs-7">
                        Un site pour les passionnés de Jeux de rôles et de fantasy.
                    </p>
                </div>

                <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#toggleMenu">
                    <span class="navbar-toggler-icon"></span>
                </div>

                <div class="collapse navbar-collapse justify-content-end" id="toggleMenu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="view/homeView.php" class="nav-link">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="view/rolePlayingView.php" class="nav-link">JDR</a>
                        </li>
                        <li class="nav-item">
                            <a href="view/galleryView.php" class="nav-link">Galerie</a>
                        </li>
                        <li class="nav-item">
                            <a href="view/contactView.php" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </div>
                <button id="connection__btn-icon" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#connection__btn">
                    <i class="fa-regular fa-user" style="color:#ffffff"></i>
                </button>

            </div>
        </nav>
    </header>

    <main class="container d-flex flex-grow-1">
        <?= $content ?>
    </main>

    <footer>
        <div class="text-center p-3 border-top">
            &copy;copyrigth 2023 - Frédéric Hot
        </div>
    </footer>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/@popperjs/core/dist/umd/popper.js"></script>
</body>

</html>