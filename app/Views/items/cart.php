<?php echo view('templates/header', ['title' => $title]); ?>

<?php if (!empty($cartItems)) : ?>
    <div class="shopping-cart">
        <div class="px-4 px-lg-0">

            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                            <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 text-uppercase">Product</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-uppercase">Price</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-uppercase">Quantity</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-uppercase">Sub-total</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-uppercase">Remove</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $subtotalprice = 0; ?>
                                        <?php foreach ($cartItems as $cartItem) : ?>
                                            <?php $subtotalprice += $cartItem['unit_price'] ?>
                                            <tr>
                                                <th scope="row" class="border-0">
                                                    <div class="p-2">
                                                        <?php foreach ($cartImages as $cartImage) : ?>
                                                            <?php if ($cartImage['product_id'] == $cartItem['product_id']) : ?>
                                                                <img src="./assets/items_img/<?= $cartImage['product_image'] ?>" alt="<?= $cartItem['product_image'] ?>" width="70" class="img-fluid rounded shadow-sm">
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <div class="ml-3 d-inline-block align-middle">
                                                            <h5 class="mb-0"> <a href="/items/<?= $cartItem['product_id'] ?>" class="text-dark d-inline-block align-middle"><?= $cartItem['product_name'] ?></a></h5>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="border-0 align-middle"><strong>Ksh. <?= $cartItem['unit_price'] ?> </strong></td>
                                                <td class="border-0 align-middle"><input class="form-control" type="number" name="quantity" id="quantity<?= $cartItem['product_id'] ?>" value="1" style="max-width: 100px;" min="1" max="<?= $cartItem['available_quantity'] ?>" required onchange="changeSubtotal(<?= $cartItem['unit_price'] ?>, $('#quantity<?= $cartItem['product_id'] ?>').val(), $('#subtotal<?= $cartItem['product_id'] ?>')[0], $('#subtotalinfo<?= $cartItem['product_id'] ?>'))"></td>
                                                <td class="border-0 align-middle"><input type="hidden" id="subtotalinfo<?= $cartItem['product_id'] ?>" value="<?= $cartItem['unit_price'] ?>"><strong><span id="subtotal<?= $cartItem['product_id'] ?>">Ksh. <?= $cartItem['unit_price'] ?></span></strong></td>
                                                <td class="border-0 align-middle"><a role="button" class="text-dark" onclick="deleteCartItem(<?= $cartItem['product_id'] ?>)"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End -->
                        </div>
                    </div>

                    <div class="row py-5 p-4 bg-white rounded shadow-sm">
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
                            <div class="p-4">
                                <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
                                <div class="input-group mb-4 border rounded-pill p-2">
                                    <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
                                    <div class="input-group-append border-0">
                                        <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                            <div class="p-4">
                                <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong><span id="order_subtotal">Ksh. <span id="order_subtotal"><?= $subtotalprice ?></span></strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>Ksh. <span id="shipping">100</span></strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>Ksh. 0</strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                                        <h5 class="font-weight-bold">Ksh. <span id="total_price"><?= $subtotalprice + 100 ?></span></h5>
                                    </li>
                                </ul>
                                <div style="width: 90%; margin: 10px auto;">
                                    <select class="form-select rounded-pill" id="paymentmethod" required>
                                        <option disabled selected value="def">Choose a payment method:</option>
                                        <?php if (!empty($paymenttypes)) : ?>
                                            <?php foreach ($paymenttypes as $paymenttype) : ?>
                                                <option value="<?= esc($paymenttype['paymenttype_id']) ?>">
                                                    <p><?= esc($paymenttype['paymenttype_name']) ?><?php echo " => " ?><?= esc($paymenttype['description']) ?></p>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div style="text-align:center; margin: 10px auto;">
                                    <a role="button" class="btn btn-dark rounded-pill py-2 btn-block">Checkout</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        {
            var subtotalprice = <?= $subtotalprice ?>;
        }

        const changeSubtotal = (priceVal, quantityVal, elemToChange, valueToChange) => {
            elemToChange.innerText = "Ksh. " + (quantityVal * priceVal);
            this.subtotalprice -= parseInt(valueToChange.val());
            valueToChange.attr('value', (quantityVal * priceVal));
            this.subtotalprice += parseInt(valueToChange.val());
            $('#order_subtotal')[0].innerText = this.subtotalprice;
            $('#total_price')[0].innerText = this.subtotalprice + parseInt($('#shipping')[0].innerText);
        };

        const deleteCartItem = (productID) => {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('CartController/deleteCartItem') ?>',
                data: {
                    productID: productID,
                    userID: <?= session()->get('id') ?>
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }

            });
        };
    </script>
<?php else : ?>
    <div style="text-align: center; color:whitesmoke; padding-top: 150px; height: 500px; background: url(&quot;<?= base_url("assets/img/oops.jpg") ?>&quot;) center / cover no-repeat;">
        <h4>Oops. Your cart is empty. Add items first then come back.</h4>
        <a href="/items" role="button" class="btn btn-primary">Go to Shop</a>
    </div>
<?php endif; ?>
<?php echo view('templates/footer'); ?>