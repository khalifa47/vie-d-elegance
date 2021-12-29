<?php echo view('templates/header', ['title' => $title]); ?>

<head>
    <link rel="stylesheet" href="<?= base_url('assets/css/charts/style_analytics.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/charts/c3.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/charts/morris.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/charts/chartist.css') ?>">
</head>

<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Vie d'Elegance Admin Dashboard</h2>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="ecommerce-widget">

                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted">Total Revenue</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1">Ksh. <?= $salestotal[0]['order_amount'] ?></h1>
                                    </div>
                                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                        <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                                    </div>
                                </div>
                                <div id="sparkline-revenue"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted">Site Traffic</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1">$12099</h1>
                                    </div>
                                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                        <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                                    </div>
                                </div>
                                <div id="sparkline-revenue2"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted">Refunds</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1">0.00</h1>
                                    </div>
                                    <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                                        <span>N/A</span>
                                    </div>
                                </div>
                                <div id="sparkline-revenue3"></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-muted">Avg. Revenue Per User</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1">Ksh. <?= number_format($salestotal[0]['order_amount'] / $userscount, 2) ?></h1>
                                    </div>
                                    <div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
                                        <span>-2.00%</span>
                                    </div>
                                </div>
                                <div id="sparkline-revenue4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->

                        <!-- recent orders  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Customer Orders</h5>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-light">
                                                <tr class="border-0">
                                                    <th class="border-0">OrderID</th>
                                                    <th class="border-0">User</th>
                                                    <th class="border-0">Total Price</th>
                                                    <th class="border-0">Order Time</th>
                                                    <th class="border-0">Payment Type</th>
                                                    <th class="border-0">Status</th>
                                                    <th class="border-0">Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orders as $order) : ?>
                                                    <tr>
                                                        <td><?= $order['order_id'] ?></td>
                                                        <?php foreach ($users as $user) : ?>
                                                            <?php if ($order['customer_id'] == $user['user_id']) : ?>
                                                                <td><?= $user['first_name'] . " " . $user['last_name'] ?></td>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>

                                                        <td><?= $order['order_amount'] ?></td>
                                                        <td><?= $order['created_at'] ?></td>
                                                        <?php foreach ($paymenttypes as $paymenttype) : ?>
                                                            <?php if ($paymenttype['paymenttype_id'] == $order['payment_type']) : ?>
                                                                <td><?= $paymenttype['paymenttype_name'] ?></td>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <td><?= $order['order_status'] ?></td>
                                                        <td><a style="color: black; text-decoration:none;" href="/receipt/<?= $order['order_id'] ?>"><i class="fa fa-file-text" aria-hidden="true"></i> Print</a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="9"><a href="#" class="btn btn-outline-light float-right">View Details</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end customer orders  -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12">
                            <!-- ============================================================== -->
                            <!-- top spending users  -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <h5 class="card-header">Top Customers</h5>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table no-wrap p-table">
                                            <thead class="bg-light">
                                                <tr class="border-0">
                                                    <th class="border-0">UserID</th>
                                                    <th class="border-0">Full Name</th>
                                                    <th class="border-0">Email</th>
                                                    <th class="border-0">Gender</th>
                                                    <th class="border-0">Spent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $user) : ?>
                                                    <tr>
                                                        <td><?= $user['user_id'] ?></td>
                                                        <td><?= $user['first_name']  . " " . $user['last_name'] ?></td>
                                                        <td><?= $user['email'] ?></td>
                                                        <td><?= $user['gender'] ?></td>
                                                        <td>Ksh. <?= $user['order_amount'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <a href="#" class="btn btn-outline-light float-right">View all users</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end top spending  -->
                            <!-- ============================================================== -->

                            <!-- ============================================================== -->
                            <!-- top performing products  -->
                            <!-- ============================================================== -->
                            <div class="card">
                                <h5 class="card-header">Top Products</h5>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table no-wrap p-table">
                                            <thead class="bg-light">
                                                <tr class="border-0">
                                                    <th class="border-0">ProductID</th>
                                                    <th class="border-0">Product Name</th>
                                                    <th class="border-0">Unit Price</th>
                                                    <th class="border-0">Available Quantity</th>
                                                    <th class="border-0">Sold</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($topproducts as $topproduct) : ?>
                                                    <tr>
                                                        <td><?= $topproduct['product_id'] ?></td>
                                                        <td><?= $topproduct['product_name'] ?></td>
                                                        <td>Ksh. <?= $topproduct['unit_price'] ?></td>
                                                        <td><?= $topproduct['available_quantity'] ?></td>
                                                        <td>Ksh. <?= $topproduct['orderdetails_total'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <a href="/items" class="btn btn-outline-light float-right">View all products</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end top performing products  -->
                            <!-- ============================================================== -->
                        </div>
                    </div>

                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- sales  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="card border-3 border-top border-top-primary">
                                <div class="card-body">
                                    <h5 class="text-muted">Sales</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1">Ksh. <?= $salestotal[0]['order_amount'] ?></h1>
                                    </div>
                                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end sales  -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- new customer  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="card border-3 border-top border-top-primary">
                                <div class="card-body">
                                    <h5 class="text-muted">Customer</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1"><?= $userscount ?></h1>
                                    </div>
                                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end new customer  -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- visitor  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="card border-3 border-top border-top-primary">
                                <div class="card-body">
                                    <h5 class="text-muted">Visitor</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1">13000</h1>
                                    </div>
                                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end visitor  -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- total orders  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="card border-3 border-top border-top-primary">
                                <div class="card-body">
                                    <h5 class="text-muted">Total Orders</h5>
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1"><?= $ordercount ?></h1>
                                    </div>
                                    <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                                        <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">4%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end total orders  -->
                        <!-- ============================================================== -->
                    </div>
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- category revenue  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Revenue by Category</h5>
                                <div class="card-body">
                                    <div id="c3chart_category" style="height: 420px;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end category revenue  -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- total revenue  -->
                        <!-- ============================================================== -->

                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header"> Total Revenue</h5>
                                <div class="card-body">
                                    <div id="morris_totalrevenue"></div>
                                </div>
                                <div class="card-footer">
                                    <p class="display-7 font-weight-bold"><span class="text-primary d-inline-block">$26,000</span><span class="text-success float-right">+9.45%</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
</div>

<script>
    const categoryrevenue = <?php echo json_encode($categoryrevenue); ?>;
    const rev_array = [];
    categoryrevenue.forEach(element => {
        rev_array.push([element.category_name.toUpperCase(), parseFloat(element.orderdetails_total)]);
    });
</script>

<?php echo view('templates/footer'); ?>
<script src="<?= base_url('assets/js/charts/c3.min.js') ?>"></script>
<script src="<?= base_url('assets/js/charts/d3-5.4.0.min.js') ?>"></script>
<script src="<?= base_url('assets/js/charts/morris.js') ?>"></script>
<script src="<?= base_url('assets/js/charts/raphael.min.js') ?>"></script>
<script src="<?= base_url('assets/js/charts/jquery.sparkline.js') ?>"></script>
<script src="<?= base_url('assets/js/charts/chartist.min.js') ?>"></script>
<script src="<?= base_url('assets/js/charts/dashboard-ecommerce.js') ?>"></script>