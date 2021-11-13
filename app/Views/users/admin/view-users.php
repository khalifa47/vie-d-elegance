<?php echo view('templates/header', ['title' => $title]); ?>
<?php if (!empty($users) && is_array($users)) : ?>

    <?php foreach ($users as $user) : ?>

        <h3><?= esc($user['first_name']) . " " . esc($user['last_name']) ?></h3>

        <div class="main">
            <?= esc($user['email']) ?>
        </div>
        <p><a href="/users/<?= esc($user['user_id'], 'url') ?>">View user</a></p>

    <?php endforeach; ?>

<?php else : ?>

    <h3>No Users</h3>

    <p>Unable to find any users for you.</p>

<?php endif; ?>
<?php echo view('templates/footer'); ?>