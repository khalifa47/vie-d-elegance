<?php echo view('templates/header', ['title' => $title]); ?>
<div style="background: rgb(24,25,27); padding: 20px;">
    <div class="table-responsive" data-aos="fade">
        <h1 class="text-center" style="color: white;">My Orders</h1>
        <table class="table table-striped table-dark table-bordered text-center">
            <thead>
                <tr>
                    <th>OrderID</th>
                    <th>Product</th>
                    <th>Order Total</th>
                    <th>Order Status</th>
                    <th>Payment Type</th>
                    <th>Last Updated</th>
                    <th>Receipt</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td style="padding: 0px;">
                            <div class="table-responsive text-truncate" style="font-size: 16px;">
                                <table class="table table-striped table-dark table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Sub-total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orderdetails as $orderdetail) : ?>
                                            <?php if ($order['order_id'] == $orderdetail[0]) : ?>
                                                <?php foreach ($orderdetail[1] as $item) : ?>
                                                    <tr>
                                                        <td><?= $item['product_name'] ?></td>
                                                        <td><?= $item['product_price'] ?></td>
                                                        <td><?= $item['order_quantity'] ?></td>
                                                        <td><?= $item['orderdetails_total'] ?></td>
                                                        <td><a role="button"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td><?= $order['order_amount'] ?></td>
                        <td><?= $order['order_status'] ?></td>
                        <td>PType</td>
                        <td><?= $order['updated_at'] ?></td>
                        <td><a style="color: white; text-decoration:none;" href="/receipt/<?= $order['order_id'] ?>"><i class="fa fa-file-text" aria-hidden="true"></i> Print</a></td>
                        <td><a role="button"><i class="fa fa-ban" aria-hidden="true" style="font-size: 2em;"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo view('templates/footer'); ?>
<script>
    // script comes here
</script>