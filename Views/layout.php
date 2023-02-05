<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Modifier pour rendre dynamique -->
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css">
    <!-- CDN icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../public/images/boncoin.jpg" alt="logo" width="50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/leboncoin/public">Mon Bon Coin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products">Tous les produits</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                        <span class="mx-2">Bonjour <?= $_SESSION['user']['firstName'] ?></span> <a href="profil" class="btn btn-secondary mx-2 my-2 my-sm-0">profil</a>
                        </li>
                        <li class="nav-item">
                            <a href="deconnexion" class="btn btn-secondary mx-2 my-2 my-sm-0">deconnexion</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a href="connexion" class="btn btn-secondary mx-2 my-2 my-sm-0">connexion</a>
                        </li>
                    <?php endif ?>
                    <?php if(isset($_SESSION['panier'])) : ?>
                        <li class="nav-item">
                            <a href="panier?opp=affiche" class="btn btn-secondary"><i class="bi bi-cart"></i><span class="small"><?= count($_SESSION['panier']) ?></span></a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="text-center m-3 p-2 alert alert-secondary"><?= $title ?></h1>

    <div class="container">
        <?= $content ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>