<?php echo view('templates/header', ['title' => $title]); ?>
<style>
    body {
        background: rgb(24, 25, 27);
    }
</style>
<div class="container-fluid top-container" style="color: rgb(153,154,156);">
    <div class="row">
        <div class="col-12 col-md-6 col-xl-4 offset-xl-2">
            <div class="img-container"><img class="rounded" id="expandedImg" style="width:100%" src="assets/img/img1-min.jpg">
                <div id="imgtext"></div>
            </div>
            <div class="row img-row" style="padding-right: 10px;padding-left: 10px;">
                <div class="col column"><img class="img-thumbnail img-fluid" src="assets/img/img1-min.jpg" onclick="myFunction(this);" alt="image 1"></div>
                <div class="col column"><img class="img-thumbnail img-fluid" src="assets/img/img2-min.jpg" onclick="myFunction(this);" alt="image 2"></div>
                <div class="col column"><img class="img-thumbnail img-fluid" src="assets/img/img3-min.jpg" onclick="myFunction(this);" alt="image 3"></div>
                <div class="col column"><img class="img-thumbnail img-fluid" src="assets/img/img4-min.jpg" onclick="myFunction(this);" alt="image 4"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4 offset-xl-0">
            <h1>I am Your Bad Luck</h1><img src="<?= base_url('assets/img/5-star-rating.svg') ?>" width="120px" style="padding-bottom: 5px;">
            <h2>$14.95</h2>
            <p style="font-size: 20px;">Here goes your product description. Try to add your main keywords but remember that this is a text for humans, not robots. So write easy to read sentences that make sense.</p>
            <p style="font-size: 20px;"><a href="https://1.envato.market/c/2052893/629767/10168">Click here</a> for thousands of top-notch T-SHIRT MOCKUPS to put your design on.</p>
            <ul>
                <li>Fit type: men, women, kids<br></li>
                <li>Sizes: XS to 4XL<br></li>
                <li>Machine wash cold, dry low heat<br></li>
                <li>Double-needle sleeve and bottom hem<br></li>
                <li>Lightweight<br></li>
                <li>Classic fit<br></li>
            </ul>
            <div data-reflow-type="add-to-cart" style="color: rgb(153,154,156);text-align: center;"></div>
        </div>
    </div>
</div>
<script src="https://cdn.reflowhq.com/v1/toolkit.min.js"></script>
<script src="<?= base_url('assets/js/Image-Tab-Gallery-Horizontal.js') ?>"></script>
<?php echo view('templates/footer'); ?>