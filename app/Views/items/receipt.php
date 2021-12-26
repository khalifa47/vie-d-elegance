<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title><?= esc($title) ?> | VE</title>
  <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>">
</head>

<body>
  <style>
    body {
      font-family: "Antonio";
      font-size: 18px;
      margin: 10px;
      padding: 10px;
    }

    h1 {
      text-align: center;
    }

    .column {
      float: left;
      width: 33%;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    ul {
      list-style-type: none;
      padding-left: 5px;
    }

    table,
    th,
    td {
      border: 1px grey solid;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 10px;
      text-align: center;
    }

    th {
      height: 2em;
    }
  </style>

  <h1>VIE D'ELEGANCE</h1>

  <hr />
  <div class="row">
    <div class="column">
      <h4>Order Details</h4>
      <ul>
        <li><strong>Order ID:</strong> <?= $order['order_id'] ?></li>
        <li><strong>Placed:</strong> <?= $order['created_at'] ?></li>
        <li><strong>Order Status:</strong> <?= $order['order_status'] ?></li>
        <li><strong>Paid by:</strong> <?= $paymenttype ?></li>
      </ul>
    </div>
    <div class="column">
      <h4>User Details</h4>
      <ul>
        <li><strong>Name:</strong> <?= $user['first_name'] . " " . $user['last_name'] ?></li>
        <li><strong>Email:</strong> <?= $user['email'] ?></li>
      </ul>
    </div>
    <div class="column">
      <h4>Delivery Address</h4>
      <ul>
        <li><?= $address['address-line-1'] ?></li>
        <li><?= $address['address-line-2'] ?></li>
        <li><?= $address['additional-info'] ?></li>
      </ul>
    </div>
  </div>
  <table>
    <thead>
      <tr>
        <th>Product</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Totals</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orderItems as $orderItem) : ?>
        <tr>
          <td><?= $orderItem['product_name'] ?></td>
          <td><?= $orderItem['product_price'] ?></td>
          <td><?= $orderItem['order_quantity'] ?></td>
          <td><?= $orderItem['orderdetails_total'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div style="display: flex; float: right; margin-right: 100px">
    <ul>
      <li><strong>Order Subtotal:</strong> Ksh. <?= $order['order_amount'] - 100 ?></li>
      <li><strong>Tax:</strong> Ksh. 0</li>
      <li><strong>Shipping and handling:</strong> Ksh. 100</li>
      <li><strong>Order Total:</strong> Ksh. <?= $order['order_amount'] ?></li>
    </ul>
  </div>
  <p style="text-align: center">Thank you for shopping at Vie d'Elegance!</p>
</body>

</html>