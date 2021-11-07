<?php echo view('templates/header', ['title' => $title]); ?>
<style>
    body {
        background: rgb(24, 25, 27);
    }
</style>
<div class="container mtr-5 mb-2" style="color: rgb(152,154,155);">
    <div class="row">
        <div class="col-md-2 col-12 border">
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
        <div class="col-md-10 col-12">
            <div class="shopping-grid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid7" style="font-family: Antonio, sans-serif;">
                                <div class="product-image7"><a href="#"><img src="https://images.unsplash.com/photo-1453728013993-6d66e9c9123a?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dmlld3xlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80" class="pic-1"><img src="https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="pic-2"></a><span class="product-new-label">New</span></div>
                                <div class="product-content">
                                    <h3 class="title" style="font-family: Antonio, sans-serif;font-size: 26px;padding:0;color: rgb(187,187,187);"><a href="#" class="item-name">Men's Blazer</a></h3>
                                    <ul class="rating" style="color: #fbb03b;">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                    </ul>
                                    <div class="price" style="font-family: Antonio, sans-serif;"><span style="color: rgb(187,187,187);">$15.00</span><span style="color: rgb(50,51,51);">$20.00</span></div>
                                    <div data-reflow-type="add-to-cart" style="text-align: center;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid7">
                                <div class="product-image7"><a href="#"><img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" class="pic-1"><img src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8Mnx8fGVufDB8fHx8&w=1000&q=80" class="pic-2"></a>
                                    <ul class="social">
                                        <li><a class="fa fa-search"></a></li>
                                        <li><a class="fa fa-shopping-bag"></a></li>
                                        <li><a class="fa fa-shopping-cart"></a></li>
                                    </ul><span class="product-new-label">New</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">Men's Blazer</a></h3>
                                    <ul class="rating">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                    </ul>
                                    <div class="price"><span>$15.00</span><span>$20.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('templates/footer'); ?>

<!-- <div class="def-number-input number-input safari_only mb-0 w-100">
                      <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                        class="minus decrease"></button>
                      <input class="quantity" min="0" name="quantity" value="1" type="number">
                      <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                        class="plus increase"></button>
                    </div> -->