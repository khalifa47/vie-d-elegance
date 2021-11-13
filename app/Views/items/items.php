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