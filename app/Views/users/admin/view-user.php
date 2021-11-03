<?php echo view('templates/header', ['title' => $title]); ?>
<h3><?= esc($user['first_name']) . " " . esc($user['last_name']) ?></h3>
<h5><?= esc($user['email']) ?></h5>
<?php echo view('templates/footer'); ?>