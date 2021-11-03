<?php echo view('templates/header', ['title' => $title]); ?>
<div id="add-category-bg" style="height: 600px;background: url(&quot;<?= base_url("assets/img/sewing.jpg") ?>&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box" id="add-categ-box">
        <div class="button-box" style="width: 245px;box-shadow: 0px 0px 20px 9px #ff61241f;border-radius: 20px;">
            <div id="btn-categ"></div><button class="btn btn-primary toggle-btn" type="button" onclick="category()">Category</button><button class="btn btn-primary toggle-btn" type="button" onclick="subcategory()">Subcategory</button>
        </div>
        <form id="category" class="inp-grp" style="text-align: center;">
            <input class="form-control inp-field" type="text" placeholder="Category Name" id="categ" name="categ" required="">
            <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Add Category</button>
            <div id="message-addcateg" class="alert-box"></div>
        </form>

        <form id="subcategory" class="inp-grp" style="text-align: center;">
            <input class="form-control inp-field" type="text" placeholder="Subcategory Name" id="subcateg" name="subcateg" required="">
            <select name="assoc_categ" id="assoc_categ" class="form-select inp-field">
                <option disabled selected value="def">Choose a category:</option>
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= esc($category['category_id']) ?>"><?= esc($category['category_name']) ?></option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option disabled>No categories in database</option>
                <?php endif; ?>
            </select>

            <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Add Subcategory</button>

            <div id="message-addsubcateg" class="alert-box"></div>
        </form>
    </div>
</div>
<?php echo view('templates/footer'); ?>

<script>
    const x = $("#category")[0];
    const y = $("#subcategory")[0];
    const z = $("#btn-categ")[0];

    function subcategory() {
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "110px";
        z.style.width = "135px";
    }

    function category() {
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0";
        z.style.width = "115px";
    }

    $(document).ready(() => {
        $("#category").on("submit", (e) => {
            const categ = $('#categ').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('CategoriesController/addCategory') ?>',
                data: {
                    categ: categ
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        $('#category')[0].reset();
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-addcateg').html("<li>" + response.message + "</li>");
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-addcateg').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });

        $("#subcategory").on("submit", (e) => {
            const subcateg = $('#subcateg').val();
            const assoc_categ = $('#assoc_categ').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('CategoriesController/addSubcategory') ?>',
                data: {
                    subcateg: subcateg,
                    assoc_categ: assoc_categ
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    $('#subcategory')[0].reset();
                    if (response.status == 1) {
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-addsubcateg').html("<li>" + response.message + "</li>");
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-addsubcateg').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });
    });
</script>