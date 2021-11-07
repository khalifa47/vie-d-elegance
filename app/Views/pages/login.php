<?php echo view('templates/header', ['title' => $title]); ?>
<div id="login-and-register-bg" style="height: 600px;background: url(&quot;<?= base_url("assets/img/sewing.jpg") ?>&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <div class="button-box" style="width: 220px;box-shadow: 0px 0px 20px 9px #ff61241f;border-radius: 20px;">
            <div id="btn"></div><button class="btn btn-primary toggle-btn" type="button" onclick="login()">Log In</button><button class="btn btn-primary toggle-btn" type="button" onclick="register()">Register</button>
        </div>
        <form id="login" class="inp-grp" style="text-align: center;"><input class="form-control inp-field" type="email" placeholder="Email" id="emailadd" name="emailadd" required=""><input class="form-control inp-field" type="password" id="pass" name="pass" placeholder="Password" required=""><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Log In</button>
            <div id="message-login" class="alert-box">

            </div>
        </form>
        <form id="register" class="inp-grp" style="text-align: center;">
            <input class="form-control inp-field" type="text" placeholder="First Name" id="fname" name="fname" required="">
            <input class="form-control inp-field" type="text" placeholder="Last Name" id="lname" name="lname" required="">
            <input class="form-control inp-field" type="email" id="emailadd" name="emailadd" placeholder="E-mail" required="">
            <input class="form-control inp-field" type="password" id="pass" name="pass" placeholder="Password" required="" minlength="7">
            <input class="form-control inp-field" type="password" id="confpass" name="confpass" placeholder="Confirm Password" required="" minlength="7">
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

            <div id="message-reg" class="alert-box">

            </div>
        </form>
    </div>
</div>
<?php echo view('templates/footer'); ?>
<script>
    const x = $("#login")[0];
    const y = $("#register")[0];
    const z = $("#btn")[0];

    function register() {
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "95px";
        z.style.width = "110px";
    }

    function login() {
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0";
        z.style.width = "95px";
    }

    $(document).ready(() => {
        $("#register").on("submit", (e) => {
            const firstname = $('#fname').val();
            const lastname = $('#lname').val();
            const emailaddress = $('#emailadd').val();
            const pass = $('#pass').val();
            const confPass = $('#confpass').val();
            const gender = $('input[name="gender"]:checked').val();

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
                    gender: gender
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    if (response.status == 1) {
                        $('#register')[0].reset();
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-reg').html("<li>" + response.message + "</li>");
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-reg').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });

        $("#login").on("submit", (e) => {
            const emailaddress = $('#emailadd').val();
            const pass = $('#pass').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('UsersController/login') ?>',
                data: {
                    emailadd: emailaddress,
                    pass: pass
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                cache: false,

                success: (response) => {
                    $('#login')[0].reset();
                    if (response.status == 1) {
                        $(".alert-box").css({
                            'display': 'block',
                            'background-color': 'rgb(0, 247, 164)',
                            'color': 'green',
                            'border-color': 'green'
                        });
                        $('#message-login').html("<li>" + response.message + "</li>");
                        location.replace('/');
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-login').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });
    });
</script>