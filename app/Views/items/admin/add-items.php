<?php echo view('templates/header', ['title' => $title]); ?>
<style>
    body {
        background: rgb(24, 25, 27);
    }
</style>
<div class="m-5">
    <div id="backdrop" class="backdrop backdrop-transition backdrop-dark">
        <div class="text-center w-100" style="position: absolute;top: 50%;">
            <div class="bg-light border rounded border-success shadow-lg m-auto" style="width: 150px;height: 150px;"><i class="fa fa-upload d-block p-4" style="font-size: 50px;"></i><span>Drop file to attach</span></div>
        </div>
    </div>
    <div class="bg-light border rounded border-light pt-1 jumbotron py-5 px-4">
        <div class="alert alert-success invisible" role="alert"><span id="notify"></span></div>
        <h1>File Drop<br></h1>
        <p><label class="form-label" for="form-files"><a class="btn btn-secondary btn-sm" role="button">Choose Files</a></label>&nbsp;or drag the files to anywhere on this page.<br></p>
        <p id="filecount"><br></p>
        <div id="list"></div>
        <form id="add-items" enctype="multipart/form-data">
            <input class="form-control invisible" type="file" id="form-files" accept="image/*" multiple="">
            <hr>
            <input class="form-control margin-space" type="text" placeholder="Item Name" id="iname" name="iname" required>
            <textarea class="form-control margin-space" id="idesc" rows="3" placeholder="Write the item's description here..." required></textarea>
            <input class="form-control margin-space" type="text" placeholder="Alt Text of Image" id="alttext" name="alttext" required>
            <input class="form-control margin-space" type="number" placeholder="Unit Price" id="unitprice" name="unitprice" required>
            <input class="form-control margin-space" type="number" placeholder="Available Quantity" id="available_q" name="available_q" required>

            <select name="categs" id="categs" class="form-select margin-space" required>
                <option disabled selected value="def">Choose a category:</option>
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= esc($category['category_id']) ?>"><?= ucwords(esc($category['category_name'])) ?></option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option disabled>No categories in database</option>
                <?php endif; ?>
            </select>

            <select name="subcategs" id="subcategs" class="form-select margin-space">
                <option id="def_sub" disabled selected value="def">Choose a subcategory:</option>
            </select>

            <!-- hidden input value -->
            <input type="hidden" id="admin_id" name="admin_id" value="<?= esc($user['user_id']) ?>">
            <hr>
            <button class="btn btn-outline-primary" type="submit">Submit</button>
            <button class="btn btn-danger" type="reset" onclick="clearFiles()">Reset</button>

        </form>
    </div>
    <div class="text-center bg-light border rounded border-dark shadow-lg p-3"><img id="image_preview" width="100">
        <div><button class="btn btn-warning btn-sm m-3" onclick="previewClose()">Close</button></div>
    </div>
    <div id="message-add-items" class="alert-box"></div>
</div>
<?php echo view('templates/footer'); ?>

<script>
    $(document).ready(() => {
        $('#categs').on("change", (e) => {
            const categ_id = $('#categs').val();

            $.ajax({
                type: 'POST',
                url: "<?= base_url('ItemsController/getSubcategories') ?>",
                data: {
                    categ_id: categ_id
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        $('#subcategs').find('option').not(':first').remove();
                        response.subcats.forEach(subcat => {
                            $('#subcategs').append(`<option value="${subcat.subcategory_id}">${subcat.subcategory_name}</option>`);
                        });
                    } else {
                        $('#def_sub').text("An error occured");
                    }
                }
            });
        });

        $("#add-items").on("submit", (e) => {
            const item_images = document.getElementById('form-files').files;
            const item_name = $('#iname').val();
            const item_desc = $('#idesc').val();
            const alttext = $('#alttext').val();
            const unit_price = $('#unitprice').val();
            const available_quantity = $('#available_q').val();
            const category = $('#categs').val();
            const subcategory = $('#subcategs').val();
            const admin_id = $('#admin_id').val();

            e.preventDefault();

            let form_data = new FormData();
            form_data.append("iname", item_name);
            form_data.append("idesc", item_desc);
            form_data.append("alttext", alttext);
            form_data.append("uprice", unit_price);
            form_data.append("av_q", available_quantity);
            form_data.append("subcat", subcategory);
            form_data.append("admin_id", admin_id);

            const fileCount = item_images.length;
            for (let index = 0; index < fileCount; index++) {
                form_data.append("item_images[]", item_images[index]);
            }

            $.ajax({
                type: 'POST',
                url: '<?= base_url('ItemsController/addItem') ?>',
                data: form_data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        $('#add-items')[0].reset();
                        clearFiles();
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-add-items').html("<li>" + response.message + "</li>");
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-add-items').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });
    });
</script>