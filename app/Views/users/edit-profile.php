<?php echo view('templates/header', ['title' => $title]); ?>
<div id="login-and-register-bg" style="height: 600px;background: url(&quot;assets/img/sewing.jpg&quot;) center / cover no-repeat, linear-gradient(rgba(0,0,0,0.4) 100%, rgba(0,0,0,0.4) 100%, white 100%);">
    <div class="form-box">
        <div class="text-center text-white button-box" style="width: 220px;box-shadow: 0px 0px 20px 9px #ff61241f;border-radius: 20px;">
            <h1>Edit Profile</h1>
        </div>
        <form id="edit-profile-form" class="inp-grp" method="post" action="/UsersController/edit" style="text-align: center;">
            <input type="hidden" name="id" value="<?= esc($user['user_id']) ?>">
            <input class="form-control inp-field" type="text" value="<?= esc($user['first_name']) ?>" name="fname" required="">
            <input class="form-control inp-field" type="text" value="<?= esc($user['last_name']) ?>" name="lname" required="">
            <input class="form-control inp-field" type="email" name="emailadd" value="<?= esc($user['email']) ?>" required="">
            <button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);margin-top: 22px;border-radius: 20px;">Save Changes</button>
        </form>
    </div>
</div>
<?php echo view('templates/footer'); ?>