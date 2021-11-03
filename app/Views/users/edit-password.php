<?php echo view('templates/header', ['title' => $title]); ?>
<div id="edit-password-bg" style="height: 600px;background: url(&quot;assets/img/sewing.jpg&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <div class="text-center text-white button-box" style="width: 220px;border-radius: 20px;">
            <h1 style="color: rgba(255, 255, 255, 0.6)">Edit Password</h1>
        </div>
        <form id="edit-password-form" class="inp-grp" style="text-align: center;">
            <input type="hidden" id="id" name="id" value="<?= esc($user['user_id']) ?>">
            <input class="form-control inp-field" type="password" id="old-pass" name="old-pass" placeholder="Old Password" required="">
            <input class="form-control inp-field" type="password" id="new-pass" name="new-pass" placeholder="New Password" required="">
            <input class="form-control inp-field" type="password" id="conf-new-pass" name="conf-new-pass" placeholder="Confirm New Password" required="">
            <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Confirm Change</button>
            <div id="message-editpass" class="alert-box"></div>
        </form>
    </div>
</div>
<?php echo view('templates/footer'); ?>

<script>
    $(document).ready(() => {
        $("#edit-password-form").on("submit", (e) => {
            const oldPass = $('#old-pass').val();
            const newPass = $('#new-pass').val();
            const confNewPass = $('#conf-new-pass').val();
            const id = $('#id').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('UsersController/editPass') ?>',
                data: {
                    id: id,
                    oldPass: oldPass,
                    newPass: newPass,
                    confNewPass: confNewPass
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    $('#edit-password-form')[0].reset();
                    if (response.status == 1) {
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-editpass').html("<li>" + response.message + "</li>");
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-editpass').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });
    });
</script>