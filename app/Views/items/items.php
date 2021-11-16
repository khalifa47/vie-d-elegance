<?php echo view('templates/header', ['title' => $title]); ?>
<style>
    body {
        background: rgb(24, 25, 27);
    }
</style>
<div class="container mtr-5 mb-2" style="color: rgb(152,154,155);">
    <div class="row">
        <div class="col-md-2 col-12 border" style="border-radius: 5px;">
            <p class="lead text-center mb-0">Sort By:</p>
            <select class="form-control" name="sort">
                <option value="all" selected="">All</option>
                <option value="popularity">Popularity</option>
                <option value="price_low">Price: Low to High</option>
                <option value="price_high">Price: High to Low</option>
                <option value="newest">Newest Arrivals</option>
            </select>
            <hr>
            <p class="lead text-center mb-0">Category:</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="all-cat" id="all-cat" checked>
                <label class="form-check-label" for="all-cat">
                    All
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="men" id="men">
                <label class="form-check-label" for="men">
                    Men
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="women" id="women">
                <label class="form-check-label" for="women">
                    Women
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="children" id="children">
                <label class="form-check-label" for="children">
                    Children
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="pets" id="pets">
                <label class="form-check-label" for="pets">
                    Pets
                </label>
            </div>
            <hr>
            <p class="lead text-center mb-0">Subcategory:</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="all-subcat" id="all-subcat" checked>
                <label class="form-check-label" for="all-subcat">
                    All
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="formal" id="formal">
                <label class="form-check-label" for="men">
                    Formal
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="casual" id="casual">
                <label class="form-check-label" for="casual">
                    Casual
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="sports" id="sports">
                <label class="form-check-label" for="sports">
                    Sports
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="dogs" id="dogs">
                <label class="form-check-label" for="dogs">
                    Dogs
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="cats" id="cats">
                <label class="form-check-label" for="cats">
                    Cats
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="other" id="other">
                <label class="form-check-label" for="other">
                    Other
                </label>
            </div>

        </div>

        <?php if (!empty($items)) : ?>
            <div class="col-md-10 col-12">
                <div class="shopping-grid">
                    <div class="container">
                        <div class="row">
                            <?php foreach ($items as $item) : ?>
                                <div class="col-md-3 col-sm-6">
                                    <div class="product-grid7" style="font-family: Antonio, sans-serif;">
                                        <div class="product-image7">
                                            <a href="/items/<?= $item['product_id'] ?>">


                                                <?php
                                                $selected_images = array();
                                                foreach ($images as $image) {
                                                    if ($item['product_id'] === $image['product_id']) {
                                                        array_push($selected_images, $image['product_image']);
                                                    }
                                                }
                                                ?>

                                                <img src="./assets/items_img/<?= $selected_images[0] ?>" alt="<?= $item['product_image'] ?>" class="pic-1">
                                                <img src="./assets/items_img/<?= $selected_images[1] ?>" alt="<?= $item['product_image'] ?>" class="pic-2">

                                                <?php if (session()->get('isLogged') && session()->get('utype') == 1) : ?>
                                                    <div class="control-div" style="position: relative; bottom: 2em; z-index: 1;">
                                                        <a class="edit" role="button" href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                        </a>
                                                        <a class="delete" role="button" href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                            </a>
                                            <ul class="social">
                                                <li><a role="button" class="fa fa-shopping-cart"></a></li>
                                            </ul>
                                            <span class="product-new-label">New</span>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title" style="font-family: Antonio, sans-serif;font-size: 26px;padding:0;color: rgb(187,187,187);"><a href="/items/<?= $item['product_id'] ?>" class="item-name"><?= $item['product_name'] ?></a></h3>
                                            <ul class="rating" style="color: #fbb03b;">
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                                <li class="fa fa-star"></li>
                                            </ul>
                                            <div class="price" style="font-family: Antonio, sans-serif;">
                                                <span style="color: rgb(187,187,187);">Ksh. <?= $item['unit_price'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <h3>No Items</h3>
            <p>Unable to find any products for you.</p>
        <?php endif; ?>
    </div>
</div>
<?php echo view('templates/footer'); ?>