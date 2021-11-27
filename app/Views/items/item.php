<?php echo view('templates/header', ['title' => $title]); ?>
<style>
    body {
        background: rgb(24, 25, 27);
    }
</style>
<div class="container-fluid top-container" style="color: rgb(153,154,156);">
    <div class="row">
        <div class="col-12 col-md-6 col-xl-4 offset-xl-2">
            <div class="img-container">
                <img class="rounded" id="expandedImg" style="width:100%; max-height: 400px; min-height:400px; object-fit:cover;" src="<?= base_url('assets/items_img/' . $images[0]['product_image']) ?>" alt="<?= $item['product_image'] ?>">
                <div id="imgtext"></div>
            </div>

            <div class="row img-row" style="padding-right: 10px;padding-left: 10px;">
                <?php $counter = 0; ?>
                <?php foreach ($images as $image) : ?>
                    <div class="col column"><img class="img-thumbnail img-fluid thumb" src="<?= base_url('assets/items_img/' . $image['product_image']) ?>" onclick="myFunction(this);" alt="image <?= $counter++ ?>"></div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4 offset-xl-0">
            <h1><?= $item['product_name'] ?></h1><img src="<?= base_url('assets/img/5-star-rating.svg') ?>" width="120px" style="padding-bottom: 5px;">
            <h2>Ksh. <?= $item['unit_price'] ?> </h2>
            <h4>Available: <?= $item['available_quantity'] ?> units</h4>
            <p style="font-size: 20px;"><?= $item['product_description'] ?></p>
            <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);border-radius: 20px; margin-left: 150px; margin-bottom: 50px;">Add To Cart</button>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/Image-Tab-Gallery-Horizontal.js') ?>"></script>
<?php echo view('templates/footer'); ?>