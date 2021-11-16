<?php echo view('templates/header', ['title' => $title]); ?>
<style>
    #forgot-pass {
        margin-top: 10px;
        padding: 0;
    }

    #forgot-pass:hover {
        color: cadetblue;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        text-align: center;
        overflow: hidden;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    #recovery-email {
        margin: 10px;
    }

    #close-btn {
        display: flex;
        align-self: flex-end;
    }
</style>

<div id="login-and-register-bg" style="height: 600px;background: url(&quot;<?= base_url("assets/img/sewing.jpg") ?>&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <div class="button-box" style="width: 220px;box-shadow: 0px 0px 20px 9px #ff61241f;border-radius: 20px;">
            <div id="btn"></div><button class="btn btn-primary toggle-btn" type="button" onclick="login()">Log In</button><button class="btn btn-primary toggle-btn" type="button" onclick="register()">Register</button>
        </div>
        <form id="login" class="inp-grp" style="text-align: center;">
            <input class="form-control inp-field" type="email" placeholder="Email" id="emailadd" name="emailadd" required="">
            <input class="form-control inp-field" type="password" id="pass" name="pass" placeholder="Password" required="">
            <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Log In</button>
            <br><a id="forgot-pass" href="#" class="btn" role="button">Forgotten Password?</a>

            <div id="message-login" class="alert-box"></div>
        </form>
        <div id="forgotPassDialog" class="modal">
            <div class="modal-content">
                <button id="close-btn" type="button" class="btn-close" aria-label="Close"></button>
                <form id="pass-recovery-form">
                    <input type="email" class="form-control" id="recovery-email" placeholder="Enter recovery email address here..." required>
                    <button type="submit" class="btn btn-primary">Send Recovery Password</button>
                </form>
                <div id="message-forget-pass" class="alert-box"></div>
            </div>
        </div>
        <form id="register" class="inp-grp" style="text-align: center;">
            <input class="form-control inp-field" type="text" placeholder="First Name" id="fname" name="fname" required="">
            <input class="form-control inp-field" type="text" placeholder="Last Name" id="lname" name="lname" required="">
            <input class="form-control inp-field" type="email" id="emailadd-reg" name="emailadd-reg" placeholder="E-mail" required="">
            <input class="form-control inp-field" type="password" id="pass-reg" name="pass-reg" placeholder="Password" required="" minlength="7">
            <input class="form-control inp-field" type="password" id="confpass" name="confpass" placeholder="Confirm Password" required="" minlength="7">
            <input type="hidden" id="role" value="2">
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
    // move between login and register
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

    //display dialog if forgot password
    const modal = $("#forgotPassDialog")[0];
    const forgot_btn = $("#forgot-pass")[0];
    const close_btn = $("#close-btn")[0];

    forgot_btn.onclick = () => {
        modal.style.display = "block"; // When the user clicks on the button, open the modal
    }

    close_btn.onclick = () => {
        modal.style.display = "none"; // When the user clicks on x, close the modal
    }

    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = "none"; // When the user clicks anywhere outside of the modal, close it
        }
    }

    //document ready
    $(document).ready(() => {
        //on submitting password recovery
        $("#pass-recovery-form").on("submit", (e) => {
            const recoveryEmail = $('#recovery-email').val();

            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('UsersController/forgetPassword') ?>',
                data: {
                    recoveryEmail: recoveryEmail
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
                        $('#message-forget-pass').html("<li>" + response.message + "</li>");
                    } else {
                        $(".alert-box").css({
                            'display': 'block'
                        });
                        $('#message-forget-pass').html("<li>" + response.message + "</li>");
                    }
                }

            });
        });

        //on submitting register
        $("#register").on("submit", (e) => {
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

        //on submitting login
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