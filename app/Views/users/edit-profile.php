<?php echo view('templates/header', ['title' => $title]); ?>
<div id="edit-profile-bg" style="height: 600px;background: url(&quot;assets/img/sewing.jpg&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <div class="text-center text-white button-box" style="width: 220px;box-shadow: 0px 0px 20px 9px #ff61241f;border-radius: 20px;">
            <h1>Edit Profile</h1>
        </div>
        <form id="edit-profile-form" class="inp-grp" style="text-align: center;">
            <input type="hidden" id="id" name="id" value="<?= esc($user['user_id']) ?>">
            <input class="form-control inp-field" type="text" value="<?= esc($user['first_name']) ?>" id="fname" name="fname" required="">
            <input class="form-control inp-field" type="text" value="<?= esc($user['last_name']) ?>" id="lname" name="lname" required="">
            <input class="form-control inp-field" type="email" id="emailadd" name="emailadd" value="<?= esc($user['email']) ?>" required="">
            <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Save Changes</button>
            <div id="message-edit" class="alert-box"></div>
        </form>
    </div>
</div>
<?php echo view('templates/footer'); ?>

<script>
    $(document).ready(() => {
        $("#edit-profile-form").on("submit", (e) => {
            const firstname = $('#fname').val();
            const lastname = $('#lname').val();
            const emailaddress = $('#emailadd').val();
            const id = $('#id').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('UsersController/edit') ?>',
                data: {
                    id: id,
                    fname: firstname,
                    lname: lastname,
                    emailadd: emailaddress
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
                        $('#message-edit').html("<li>" + response.message + "</li>");
                        sleep(3);
                        location.reload();
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-edit').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });
    });
</script>