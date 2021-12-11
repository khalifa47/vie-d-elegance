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
                                                    <a class="control-a" role="button" onclick="editCateg(<?= esc($category['category_id']) ?>, `<?= esc($category['category_name']) ?>`)">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>

                                                    <a class="control-a" role="button" onclick="deleteCateg(<?= esc($category['category_id']) ?>)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
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
                    <?php
                    if (session()->get('isLogged')) {
                        echo "<li class='nav-item dropdown'><a class='nav-link' aria-expanded='false' data-bs-toggle='dropdown' href='#'>Welcome, " . session()->get('uname') . "</a>
                        <div class='dropdown-menu'>
                            <a class='dropdown-item' href='/edit-profile'><i class='fa fa-user-circle ms' aria-hidden='true'></i>edit profile</a>
                            <a class='dropdown-item' href='/edit-password'><i class='fa fa-unlock ms' aria-hidden='true'></i>edit password</a>
                            <a class='dropdown-item' href='/cart'><i class='fa fa-shopping-cart ms' aria-hidden='true'></i>My Cart</a>
                        </div>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' role='button' data-bs-toggle='modal' data-bs-target='#wallet-modal'>
                                <i class='fa fa-google-wallet ms' aria-hidden='true'></i>Ksh. <span id='walletBalance'>" . session()->get('walletBal') . "</span>
                            </a>
                        </li>";
                    ?>
                    <?php

                        if (session()->get('utype') == 1) {
                            echo "<li class='nav-item dropdown'><a class='dropdown-toggle nav-link' aria-expanded='false' data-bs-toggle='dropdown' href='#'>Admin</a>
                            <div class='dropdown-menu'>
                                <a class='dropdown-item' href='/add-category'>Add Category</a>
                                <a class='dropdown-item' href='/add-item'>Add Item</a>
                                <a class='dropdown-item' href='/add-user'>Add User</a>
                                <a class='dropdown-item' role='button' data-bs-toggle='modal' data-bs-target='#payment-types-modal'>Payment Types</a>
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

    <!-- wallet modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="wallet-modal" style="text-align: center;">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-dark">TOP UP WALLET</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="walletForm" class="d-inline-flex">
                        <input type="hidden" id="walletUid" value="<?= session()->get('id') ?>">
                        <input type="hidden" id="current-balance" value="<?= session()->get('walletBal') ?>">
                        <input id="topUpInput" class="form-control" type="number" min="100" placeholder="Min: 100">
                        <button class="btn btn-primary" type="submit">Load</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- payment types modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="payment-types-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-dark">Payment Types</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($paymenttypes)) : ?>
                        <?php foreach ($paymenttypes as $paymenttype) : ?>
                            <div id="paymenttype_div<?= esc($paymenttype['paymenttype_id']) ?>" style="display: flex; justify-content:space-between;">
                                <div>
                                    <h4><?= $paymenttype['paymenttype_name'] ?></h4>
                                    <p><?= $paymenttype['description'] ?></p>
                                </div>
                                <div class="control-div">
                                    <a role="button" class="control-a" onclick="editPaymentType(<?= esc($paymenttype['paymenttype_id']) ?>, `<?= esc($paymenttype['paymenttype_name']) ?>`, `<?= esc($paymenttype['description']) ?>`)">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <a role="button" class="control-a" onclick="deletePaymentType(<?= esc($paymenttype['paymenttype_id']) ?>)">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div style="text-align: center;">
                        <button type="button" class="btn rounded-circle" style="color:blue; font-size:xx-large;" data-bs-dismiss="modal" data-bs-toggle='modal' data-bs-target='#add-payment-type-modal'><i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- add payment types modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="add-payment-type-modal" style="text-align: center;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-dark">Add Payment Type</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPaymentForm">
                        <input type="text" class="form-control margin-space" id="payment-name" placeholder="Payment Name" required>
                        <input type="text" class="form-control margin-space" id="payment-desc" placeholder="Payment Description" required>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>