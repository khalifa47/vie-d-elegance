<?php echo view('templates/header', ['title' => $title]); ?>
<div id="login-and-register-bg" style="height: 600px;background: url(&quot;assets/img/sewing.jpg&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <div class="text-center text-white button-box" style="width: 220px;border-radius: 20px;">
            <h1 style="color: rgba(255, 255, 255, 0.6)">Edit Password</h1>
        </div>
        <form id="edit-password-form" class="inp-grp" method="post" action="/UsersController/editPass" style="text-align: center;">
            <input type="hidden" name="id" value="<?= esc($user['user_id']) ?>">
            <input class="form-control inp-field" type="password" name="old-pass" placeholder="Old Password" required="">
            <input class="form-control inp-field" type="password" name="new-pass" placeholder="New Password" required="">
            <input class="form-control inp-field" type="password" name="conf-new-pass" placeholder="Confirm New Password" required="">
            <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Confirm Change</button>
        </form>
    </div>
</div>
<?php echo view('templates/footer'); ?>