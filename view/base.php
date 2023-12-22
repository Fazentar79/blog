<?php global$content,$title; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../public/design/sass/style.css">
    <title>
        <?= $title ?>
    </title>
</head>

<body class="d-flex flex-column min-vh-100" data-bs-spy="scroll" data-bs-target="#menu">

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
                        <a href="connexion" id="connection__btn" class="nav-link">
                            <span class="fa-regular fa-user ms-md-3">
                            </span>
                            <span class="fs-6">Inscription / Connection</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>

<main class="container d-flex flex-grow-1">
    <?= $content ?>
</main>

<footer>
    <div class="text-center mt-5 p-3 border-top">
        &copy;copyrigth 2023 - Frédéric Hot
    </div>
</footer>

</body>

</html>