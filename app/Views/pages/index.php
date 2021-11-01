<?php echo view('templates/header', ['title' => $title]); ?>

<div id="banner" style="height: 467.667px;">
    <div id="banner-text">
        <h1>Bringing out the best in you</h1>
        <p>Be the best, stand out above the rest, and dress to impress</p><button class="btn btn-primary" type="button">Check out our products</button>
    </div>
</div>

<div id="benefits" style="height: 600px;">
    <div id="benefits-text">
        <h1 class="display-4" style="color: rgb(61,152,205);">We offer</h1>
        <ul class="list-unstyled text-end" style="color: var(--bs-gray-200);">
            <li>High quality products</li>
            <li>Fast shipping</li>
            <li>Secure payment</li>
            <li>Affordable prices</li>
        </ul>
    </div>
</div>
<div id="gallery" style="background: rgb(24,25,27);">
    <h1 style="color: rgb(255,255,255);">Gallery</h1>
    <div class="row row-gallery">
        <div class="col-md-4">
            <div class="card"><a href="<?= base_url('assets/img/man-2.jpg') ?>" target="_blank" data-lightbox="models"><img class="img-fluid" src="<?= base_url('assets/img/man-2.jpg') ?>"></a></div>
        </div>
        <div class="col-md-4">
            <div class="card"><a href="<?= base_url('assets/img/man-3.jpg') ?>" target="_blank" data-lightbox="models"><img class="img-fluid" src="<?= base_url('assets/img/man-3.jpg') ?>"></a></div>
        </div>
        <div class="col-md-4">
            <div class="card"><a href="<?= base_url('assets/img/woman-1.jpg') ?>" target="_blank" data-lightbox="models"><img class="img-fluid" src="<?= base_url('assets/img/woman-1.jpg') ?>"></a></div>
        </div>
    </div>
    <div class="row row-gallery">
        <div class="col-md-4">
            <div class="card"><a href="../assets/img/woman-2.jpg" target="_blank" data-lightbox="models"><img class="img-fluid" src="../assets/img/woman-2.jpg"></a></div>
        </div>
        <div class="col-md-4">
            <div class="card"><a href="../assets/img/woman-4.jpg" target="_blank" data-lightbox="models"><img class="img-fluid" src="../assets/img/woman-4.jpg"></a></div>
        </div>
        <div class="col-md-4">
            <div class="card"><a href="../assets/img/tommy.jpg" target="_blank" data-lightbox="models"><img class="img-fluid" src="../assets/img/tommy.jpg"></a></div>
        </div>
    </div>
    <div class="row row-gallery">
        <div class="col-md-4">
            <div class="card"><a href="../assets/img/man-1.jpg" target="_blank" data-lightbox="models"><img class="img-fluid" src="../assets/img/man-1.jpg"></a></div>
        </div>
        <div class="col-md-4">
            <div class="card"><a href="../assets/img/woman-5.jpg" target="_blank" data-lightbox="models"><img class="img-fluid" src="../assets/img/woman-5.jpg"></a></div>
        </div>
        <div class="col-md-4">
            <div class="card"><a href="../assets/img/woman-8.jpg" target="_blank" data-lightbox="models"><img class="img-fluid" src="../assets/img/woman-8.jpg"></a></div>
        </div>
    </div>
</div>
<div class="p-5" style="background-color: #18191b;">
    <div>
        <h1 class="text-center" style="color: white;">Customer Say</h1>
    </div>
    <div class="carousel slide" data-bs-ride="carousel" id="carousel-2" style="background-color: #18191b;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container p-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow mt-2"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/david-beckham.jpg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title hSizeCont">David Beckham</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 hide">
                            <div class="card shadow custsays"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/naomi.jpg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title">Naomi Campbell</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 hide">
                            <div class="card shadow custsays"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/roro.jpg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title">Cristiano Ronaldo</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container p-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow mt-2"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/gigi.jpg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title hSizeCont">Gigi Hadid</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 hide">
                            <div class="card shadow custsays"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/lewis.jpg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title">Lewis Hamilton</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 hide">
                            <div class="card shadow custsays"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/mbj.jpg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title">Michael B. Jordan</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container p-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow mt-2"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/vir.jpg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title hSizeCont">Vir Das</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 hide">
                            <div class="card shadow custsays"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/woman-6.jpg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title">Samantha Li</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 hide">
                            <div class="card shadow custsays"><img class="card-img-top w-100 d-block" src="../assets/img/test_cover.jpg">
                                <div class="text-center"><img class="rounded-circle img-fluid bg-white border border-white shadow" src="../assets/img/woman-7.jpeg" style="width: 80px;margin-top: -40px;filter: blur(0px);"></div>
                                <div class="card-body">
                                    <h4 class="card-title">Veronica Garcia</h4>
                                    <h6 class="text-muted card-subtitle mb-2"><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star" style="color: rgb(247,176,69);"></i><i class="fa fa-star-half-o" style="color: rgb(247,176,69);"></i></h6>
                                    <p class="card-text fSizeCont">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div><a class="carousel-control-prev" href="#carousel-2" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-2" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
        <ol class="carousel-indicators">
            <li data-bs-target="#carousel-2" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carousel-2" data-bs-slide-to="1"></li>
            <li data-bs-target="#carousel-2" data-bs-slide-to="2"></li>
        </ol>
    </div>
</div>

<?php echo view('templates/footer'); ?>