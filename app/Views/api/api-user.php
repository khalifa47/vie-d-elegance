<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>API portal</title>
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Antonio&amp;display=swap">
</head>

<body>
    <style>
        body {
            font-family: 'Antonio';
        }
    </style>
    <div class="d-flex flex-fill justify-content-evenly">
        <h4 class="modal-title text-dark">API Portal</h4>
        <a class="d-sm-flex align-items-sm-center" href="https://github.com/khalifa47/vie-d-elegance#readme" target="_blank" style="font-size: 10px;">Documentation</a>
    </div>

    <div>
        <div class="d-flex flex-grow-1 justify-content-around">
            <p style="font-size: 17px;">My Key: <span><?= $key ?></span></p><button class="btn btn-primary btn-sm d-sm-flex align-items-sm-center" type="button" style="height: 28px;">Generate New Key</button>
        </div>
    </div>
    <hr>
    <div>
        <h5>Registered API Products</h5>
        <?php foreach ($products as $product) : ?>
            <div class="d-flex flex-grow-1 justify-content-between" style="height: 30.5px;">
                <p style="font-size: 17px;"><?= ucwords($product['productname']) ?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?= $product['api_token'] ?></span></p><button class="btn btn-primary btn-sm d-sm-flex align-items-sm-center" type="button" style="height: 28px;">Generate New Token</button>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>
    <div>
        <form class="d-flex"><select class="form-select">
                <optgroup label="This is a group">
                    <option value="12" selected="">This is item 1</option>
                    <option value="13">This is item 2</option>
                    <option value="14">This is item 3</option>
                </optgroup>
            </select><button class="btn btn-primary" type="button">Register</button></form>
    </div>
</body>

</html>