<?php global$title,$content; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
                        <a href="homeView.php" class="nav-link">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Univers</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
            <a href="connectionView.php" id="connection__btn-icon"><span class="fa-regular fa-user ms-5"
                                                                         style="color:#ffffff"></span>
            </a>

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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>