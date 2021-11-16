<?php echo view('templates/header', ['title' => $title]); ?>

<div id="add-user-bg" style="height: 600px;background: url(&quot;<?= base_url("assets/img/sewing.jpg") ?>&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <div class="text-center text-white button-box" style="width: 220px;border-radius: 20px;">
            <h1 style="color: rgba(255, 255, 255, 0.6)">Add User</h1>
        </div>
        <form id="add-user-form" class="inp-grp" style="text-align: center;">
            <input class="form-control inp-field" type="text" placeholder="First Name" id="fname" name="fname" required="">
            <input class="form-control inp-field" type="text" placeholder="Last Name" id="lname" name="lname" required="">
            <input class="form-control inp-field" type="email" id="emailadd-reg" name="emailadd-reg" placeholder="E-mail" required="">
            <input class="form-control inp-field" type="password" id="pass-reg" name="pass-reg" placeholder="Password" required="" minlength="7">
            <input class="form-control inp-field" type="password" id="confpass" name="confpass" placeholder="Confirm Password" required="" minlength="7">
            <select name="role" id="role" class="form-select margin-space" style="background-color: transparent;">
                <option disabled selected value="def">Choose a role:</option>
                <option value="1">Admin</option>
                <option value="2">User</option>
            </select>
            <div>
                <div class="row">
                    <div class="col">
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="formCheck-1" name="gender" value="male" checked><label class="form-check-label" for="formCheck-1">Male</label></div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="formCheck-2" name="gender" value="female"><label class="form-check-label" for="formCheck-2">Female</label></div>
                    </div>
                </div>
            </div><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Register</button>

            <div id="message-add-user" class="alert-box">

            </div>
        </form>
    </div>
</div>
<?php echo view('templates/footer'); ?>
<script>
    //document ready
    $(document).ready(() => {
        $("#add-user-form").on("submit", (e) => {
            const firstname = $('#fname').val();
            const lastname = $('#lname').val();
            const emailaddress = $('#emailadd-reg').val();
            const pass = $('#pass-reg').val();
            const confPass = $('#confpass').val();
            const gender = $('input[name="gender"]:checked').val();
            const role = $('#role').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('UsersController/register') ?>',
                data: {
                    fname: firstname,
                    lname: lastname,
                    emailadd: emailaddress,
                    pass: pass,
                    confpass: confPass,
                    gender: gender,
                    role: role
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        $('#add-user-form')[0].reset();
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-add-user').html("<li>" + response.message + "</li>");
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-add-user').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });
    });
</script>