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
                <tr>
                    <td>Cell 1</td>
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
                                    <tr>
                                        <td>Cell 1</td>
                                        <td>Cell 2</td>
                                        <td>Cell 3</td>
                                        <td>Cell 4</td>
                                        <td><a role="button"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td>Cell 6</td>
                    <td>Cell 7</td>
                    <td>Cell 8</td>
                    <td>Cell 9</td>
                    <td><a style="color: white; text-decoration:none;" href="/receipt/"><i class="fa fa-file-text" aria-hidden="true"></i> Print</a></td>
                    <td><a role="button"><i class="fa fa-ban" aria-hidden="true" style="font-size: 2em;"></i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php echo view('templates/footer'); ?>
<script>
    // script comes here
</script>