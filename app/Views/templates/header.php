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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link rel="stylesheet" href="https://cdn.reflowhq.com/v1/toolkit.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/Bold-BS4-Footer-Big-Logo.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Keet-Testimonial-01.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Navigation-with-Button.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Image-Tab-Gallery-Horizontal.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/shopping-ecommerce-products.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md sticky-top textwhite-50 bg-dark bg-gradient text-uppercase text-white-50 shadow navigation-clean-button">
        <div class="container"><a class="navbar-brand" id="brand-name" href="/"><img id="logo" src="<?= base_url('assets/img/logo.png') ?>">vie d'elegance</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto" id="navb">
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">categories</a>
                        <div class="dropdown-menu">
                            <?php if (!empty($categories)) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <div id="categ_div<?= esc($category['category_id']) ?>" style="display: flex; justify-content:space-between;">
                                        <a style="cursor: pointer;" class="dropdown-item" onclick="goToCateg(<?= esc($category['category_id']) ?>)"><?= esc($category['category_name']) ?>

                                            <?php if (session()->get('isLogged') && session()->get('utype') == 1) : ?>
                                                <div class="control-div">
                                                    <a role="button" onclick="editCateg(<?= esc($category['category_id']) ?>, `<?= esc($category['category_name']) ?>`)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                        </svg>
                                                    </a>

                                                    <a role="button" onclick="deleteCateg(<?= esc($category['category_id']) ?>)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                        </svg>
                                                    </a>

                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <a class="dropdown-item" href="#">No categories found</a>
                            <?php endif; ?>

                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">CONTACT US</a></li>
                    <?php
                    if (session()->get('isLogged')) {
                        echo "<li class='nav-item dropdown'><a class='nav-link' aria-expanded='false' data-bs-toggle='dropdown' href='#'>Welcome, " . session()->get('uname') . "</a>
                        <div class='dropdown-menu'>
                            <a class='dropdown-item' href='/edit-profile'><i class='fa fa-user-circle ms' aria-hidden='true'></i>edit profile</a>
                            <a class='dropdown-item' href='/edit-password'><i class='fa fa-unlock ms' aria-hidden='true'></i>edit password</a>
                            <a class='dropdown-item' href='/cart'><i class='fa fa-shopping-cart ms' aria-hidden='true'></i>My Cart</a>
                        </div>
                        </li>";

                        if (session()->get('utype') == 1) {
                            echo "<li class='nav-item dropdown'><a class='dropdown-toggle nav-link' aria-expanded='false' data-bs-toggle='dropdown' href='#'>Admin</a>
                            <div class='dropdown-menu'>
                                <a class='dropdown-item' href='/add-category'>Add Category</a>
                                <a class='dropdown-item' href='/add-item'>Add Item</a>
                                <a class='dropdown-item' href='/add-user'>Add User</a>
                            </div>
                            </li>";
                        }
                    }

                    ?>
                </ul>
                <?php
                if (!session()->get('isLogged')) {
                    echo "<span class='navbar-text actions'> <a class='btn btn-dark action-button' role='button' href='/login'>Log in</a></span>";
                } else {
                    echo "<span class='navbar-text actions'> <a class='btn btn-dark action-button' role='button' href='/logout'>Log Out</a></span>";
                }
                ?>
            </div>
        </div>
    </nav>