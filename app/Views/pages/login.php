<?php echo view('templates/header', ['title' => $title]); ?>
<div id="login-and-register-bg" style="height: 600px;background: url(&quot;<?= base_url("assets/img/sewing.jpg") ?>&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <div class="button-box" style="width: 220px;box-shadow: 0px 0px 20px 9px #ff61241f;border-radius: 20px;">
            <div id="btn"></div><button class="btn btn-primary toggle-btn" type="button" onclick="login()">Log In</button><button class="btn btn-primary toggle-btn" type="button" onclick="register()">Register</button>
        </div>
        <form id="login" class="inp-grp" method="post" action="/UsersController/login" style="text-align: center;"><input class="form-control form-control-lg inp-field" type="text" placeholder="Email" name="emailadd" required="" style="font-size: 20px;"><input class="form-control form-control-lg inp-field" type="password" name="pass" placeholder="Password" required=""><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Log In</button></form>
        <form id="register" class="inp-grp" method="post" action="/UsersController/register" style="text-align: center;"><input class="form-control inp-field" type="text" placeholder="First Name" name="fname" required=""><input class="form-control inp-field" type="text" placeholder="Last Name" name="lname" required=""><input class="form-control inp-field" type="email" name="emailadd" placeholder="E-mail" required=""><input class="form-control inp-field" type="password" name="pass" placeholder="Password" required="" minlength="7"><input class="form-control inp-field" type="password" name="conf-pass" placeholder="Confirm Password" required="" minlength="7">
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
</script>