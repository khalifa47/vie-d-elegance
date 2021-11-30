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
            <form id="categories">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="all-cat" id="all-cat" checked>
                    <label class="form-check-label" for="all-cat">
                        All
                    </label>
                </div>

                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= esc($category['category_id']) ?>" id="<?= esc($category['category_id']) ?>">
                            <label class="form-check-label" for="<?= esc($category['category_id']) ?>">
                                <?= ucwords(esc($category['category_name'])) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No categories found</p>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary">Apply</button>
            </form>
            <hr>
            <p class="lead text-center mb-0">Subcategory:</p>
            <form id="subcategories">
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
                <br>
                <button type="submit" class="btn btn-primary">Apply</button>
            </form>


        </div>

        <?php if (!empty($items)) : ?>
            <div class="col-md-10 col-12">
                <div class="shopping-grid">
                    <div class="container">
                        <div class="row" id="grid">
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
                                                        <button class="edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                        </button>

                                                        <button class="delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                            </svg>
                                                        </button>

                                                    </div>
                                                <?php endif; ?>

                                            </a>
                                            <ul class="social">
                                                <li>
                                                    <a role="button" class="fa fa-shopping-cart" onclick="addToCart(<?= $item['product_id'] ?>)"></a>
                                                </li>
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

<script>
    // from clicking categories on navbar
    if (window.location.href.includes('?')) {
        const url = window.location.href.split("?");

        const categs = <?= json_encode($categories) ?>;
        categs.forEach(categ => {
            if (url[1].includes(`${categ.category_id}`)) {
                $(`#${categ.category_id}`).attr('checked', true);
                $('#all-cat').attr('checked', false);
            }
        });
    }

    //add to cart
    const addToCart = (cartItem) => {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('CartController/addToCart') ?>',
            data: {
                productID: cartItem
            },
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            cache: false,

            success: (response) => {
                if (response.status == 1) {
                    // $(".alert-box").css({
                    //     'display': 'block',
                    //     'background-color': 'rgb(0, 247, 164)',
                    //     'color': 'green',
                    //     'border-color': 'green'
                    // });
                    // $('#message-add-user').html("<li>" + response.message + "</li>");
                    alert(response.message);
                } else {
                    // $(".alert-box").css({
                    //     'display': 'block'
                    // });
                    // $('#message-add-user').html("<li>" + response.message + "</li>");
                    alert(response.message);
                    location.replace('/login');
                }
            }

        });
    };

    // filtering implentation
    const grid = $('#grid')[0];

    const setItems = (item, image1, image2) => {
        const maindiv = document.createElement('div');

        const div1 = document.createElement('div');
        div1.setAttribute('class', 'col-md-3 col-sm-6');

        const div2 = document.createElement('div');
        div2.setAttribute('class', 'product-grid7');
        div2.setAttribute('style', 'font-family: Antonio, sans-serif');

        const div3 = document.createElement('div');
        div3.setAttribute('class', 'product-image7');

        const div4 = document.createElement('div');
        div4.setAttribute('class', 'product-content');

        const main_a = document.createElement('a');
        main_a.setAttribute('href', `/items/${item.product_id}`);

        const img1 = document.createElement('img');
        img1.setAttribute('class', 'pic-1');
        img1.setAttribute('src', `./assets/items_img/${image1}`);
        img1.setAttribute('alt', `${item.product_image}`);

        const img2 = document.createElement('img');
        img2.setAttribute('class', 'pic-2');
        img2.setAttribute('src', `./assets/items_img/${image2}`);
        img2.setAttribute('alt', `${item.product_image}`);

        const ul1 = document.createElement('ul');
        ul1.setAttribute('class', 'social');

        const li_ul1 = document.createElement('li');

        const a_cart = document.createElement('a');
        a_cart.setAttribute('role', 'button');
        a_cart.setAttribute('class', 'fa fa-shopping-cart');

        const new_span = document.createElement('span');
        new_span.setAttribute('class', 'product-new-label');
        new_span.innerText = "New";

        const h3 = document.createElement('h3');
        h3.setAttribute('class', 'title');
        h3.setAttribute('style', 'font-family: Antonio, sans-serif;font-size: 26px;padding:0;color: rgb(187,187,187);');

        const item_a = document.createElement('a');
        item_a.setAttribute('class', 'item-name');
        item_a.setAttribute('href', `/items/${item.product_id}`);
        item_a.innerText = item.product_name;

        const ul2 = document.createElement('ul');
        ul2.setAttribute('class', 'rating');
        ul2.setAttribute('style', 'color: #fbb03b');

        const li1_ul2 = document.createElement('li');
        const li2_ul2 = document.createElement('li');
        const li3_ul2 = document.createElement('li');
        const li4_ul2 = document.createElement('li');
        const li5_ul2 = document.createElement('li');
        li1_ul2.setAttribute('class', 'fa fa-star');
        li2_ul2.setAttribute('class', 'fa fa-star');
        li3_ul2.setAttribute('class', 'fa fa-star');
        li4_ul2.setAttribute('class', 'fa fa-star');
        li5_ul2.setAttribute('class', 'fa fa-star');

        const div5 = document.createElement('div');
        div5.setAttribute('class', 'price');
        div5.setAttribute('style', 'font-family: Antonio, sans-serif;');

        const price_span = document.createElement('div');
        price_span.setAttribute('style', 'color: rgb(187,187,187)');
        price_span.innerText = `Ksh. ${item.unit_price}`;

        div5.appendChild(price_span);
        ul2.appendChild(li5_ul2);
        ul2.appendChild(li4_ul2);
        ul2.appendChild(li3_ul2);
        ul2.appendChild(li2_ul2);
        ul2.appendChild(li1_ul2);
        h3.appendChild(item_a);
        div4.appendChild(h3);
        div4.appendChild(ul2);
        div4.appendChild(div5);
        div3.appendChild(new_span);
        li_ul1.appendChild(a_cart);
        ul1.appendChild(li_ul1);
        div3.appendChild(ul1);
        main_a.appendChild(img2);
        main_a.appendChild(img1);
        div3.appendChild(main_a);
        div2.appendChild(div3);
        div2.appendChild(div4);
        div1.appendChild(div2);
        maindiv.appendChild(div1);

        grid.innerHTML += maindiv.innerHTML;
    };

    $(document).ready(() => {
        // filtering by categories
        $("#categories").on("submit", (e) => {

            const all = $('#all-cat').prop('checked') ? $('#all-cat').val() : null;
            const male = $('#1').prop('checked') ? $('#1').val() : null;
            const female = $('#2').prop('checked') ? $('#2').val() : null;
            const children = $('#3').prop('checked') ? $('#3').val() : null;
            const pet = $('#4').prop('checked') ? $('#4').val() : null;

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('ItemsController/changeCateg') ?>',
                data: {
                    all_cat: all,
                    male: male,
                    female: female,
                    children: children,
                    pets: pet
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        grid.innerHTML = "";
                        if (response.result_set.all.length !== 0) {
                            response.result_set.all.forEach(product => {
                                const selected_images = [];

                                response.images.forEach(image => {
                                    if (product.product_id == image.product_id) {
                                        selected_images.push(image.product_image);
                                    }
                                });

                                setItems(product, selected_images[0], selected_images[1]);
                            });
                        } else {
                            if (response.result_set.men.length !== 0) {
                                response.result_set.men.forEach(product => {
                                    const selected_images = [];

                                    response.images.forEach(image => {
                                        if (product[0].product_id == image.product_id) {
                                            selected_images.push(image.product_image);
                                        }
                                    });

                                    setItems(product[0], selected_images[0], selected_images[1]);
                                });
                            }
                            if (response.result_set.women.length !== 0) {
                                response.result_set.women.forEach(product => {
                                    const selected_images = [];

                                    response.images.forEach(image => {
                                        if (product[0].product_id == image.product_id) {
                                            selected_images.push(image.product_image);
                                        }
                                    });

                                    setItems(product[0], selected_images[0], selected_images[1]);
                                });
                            }
                            if (response.result_set.children.length !== 0) {
                                response.result_set.children.forEach(product => {
                                    const selected_images = [];

                                    response.images.forEach(image => {
                                        if (product[0].product_id == image.product_id) {
                                            selected_images.push(image.product_image);
                                        }
                                    });

                                    setItems(product[0], selected_images[0], selected_images[1]);
                                });
                            }
                            if (response.result_set.pets.length !== 0) {
                                response.result_set.pets.forEach(product => {
                                    const selected_images = [];

                                    response.images.forEach(image => {
                                        if (product[0].product_id == image.product_id) {
                                            selected_images.push(image.product_image);
                                        }
                                    });

                                    setItems(product[0], selected_images[0], selected_images[1]);
                                });
                            }
                        }

                    } else {
                        grid.innerHTML = "<h3>An error occurred</h3>";
                    }
                }
            });
        });
    });
</script>