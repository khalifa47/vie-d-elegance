<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= esc($title) ?> | VE</title>
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Antonio&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide&amp;display=swap">
    <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Bold-BS4-Footer-Big-Logo.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/Keet-Testimonial-01.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Navigation-with-Button.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md sticky-top textwhite-50 bg-dark bg-gradient text-uppercase text-white-50 shadow navigation-clean-button">
        <div class="container"><a class="navbar-brand" id="brand-name" href="/"><img id="logo" src="<?= base_url('assets/img/logo.png') ?>">vie d'elegance</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto" id="navb">
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">categories</a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="#">men's wear</a><a class="dropdown-item" href="#">women's wear</a><a class="dropdown-item" href="#">children's wear</a><a class="dropdown-item" href="#">pet's wear</a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">CONTACT US</a></li>
                    <?php
                    if (session()->get('isLogged')) {
                        echo "<li class='nav-item dropdown'><a class='nav-link' aria-expanded='false' data-bs-toggle='dropdown' href='#'>Welcome, " . session()->get('uname') . "</a>
                        <div class='dropdown-menu'><a class='dropdown-item' href='/edit-profile'>edit profile</a><a class='dropdown-item' href='/edit-password'>edit password</a></div>
                        </li>";
                    }
                    ?>
                </ul>
                <?php
                if (!session()->get('isLogged')) {
                    echo "<span class='navbar-text actions'> <a class='btn btn-dark action-button' role='button' href='/login'>Log in</a></span>";
                } else {
                    echo "<span class='navbar-text actions'> <a class='btn btn-dark action-button' id='logoutbtn' role='button' href='/logout'>Log Out</a></span>";
                }
                ?>
            </div>
        </div>
    </nav>