<?php echo view('templates/header', ['title' => $title]); ?>
<div id="address-bg" style="height: 600px;background: url(&quot;assets/img/sewing.jpg&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <h1 class="text-center" style="margin: 20px;color: rgb(249,251,252);">Delivery Address</h1>
        <?php if (empty($address)) : ?>
            <form id="addressForm" style="margin: 40px;text-align: center;">
                <input type="hidden" id="userID" value="<?= session()->get('id') ?>">
                <input class="form-control inp-field" type="text" id="add-line-1" placeholder="Address Line 1" required>
                <input class="form-control inp-field" type="text" id="add-line-2" placeholder="Address Line 2" required>
                <textarea class="form-control inp-field" id="add-info" placeholder="Additional Information"></textarea>
                <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Save Address</button>
                <div id="message-address" class="alert-box"></div>
            </form>
        <?php else : ?>
            <form id="updateAddressForm" style="margin: 40px;text-align: center;">
                <input type="hidden" id="userID" value="<?= session()->get('id') ?>">
                <input class="form-control inp-field" type="text" id="add-line-1" value="<?= $address['address-line-1'] ?>" required>
                <input class="form-control inp-field" type="text" id="add-line-2" value="<?= $address['address-line-2'] ?>" required>
                <textarea class="form-control inp-field" id="add-info" value="<?= $address['additional-info'] ?>"><?= $address['additional-info'] ?></textarea>
                <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Update Address</button>
                <div id="message-address" class="alert-box"></div>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php echo view('templates/footer'); ?>
<script>
    $(document).ready(() => {
        $("#addressForm").on("submit", (e) => {
            const uid = $('#userID').val();
            const line1 = $('#add-line-1').val();
            const line2 = $('#add-line-2').val();
            const add = $('#add-info').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('AddressController/addAddress') ?>',
                data: {
                    uid: uid,
                    line1: line1,
                    line2: line2,
                    add: add
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-addresss').html("<li>" + response.message + "</li>");
                        location.reload();
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-address').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });

        $("#updateAddressForm").on("submit", (e) => {
            const uid = $('#userID').val();
            const line1 = $('#add-line-1').val();
            const line2 = $('#add-line-2').val();
            const add = $('#add-info').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('AddressController/updateAddress') ?>',
                data: {
                    uid: uid,
                    line1: line1,
                    line2: line2,
                    add: add
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-address').html("<li>" + response.message + "</li>");
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-address').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });
    });
</script>