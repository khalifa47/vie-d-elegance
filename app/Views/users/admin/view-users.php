<?php echo view('templates/header', ['title' => $title]); ?>
<?php if (!empty($users) && is_array($users)) : ?>

    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>E-mail address</th>
            <th>Gender</th>
            <th class="sortable" onclick="sortTable('users-table', 7)">User role</th>
        </tr>

        <?php foreach ($users as $user) : ?>

            <tr onclick="window.location.href='/users/<?= esc($user['user_id']) ?>'">
                <td><?= esc($user['user_id']) ?></td>
                <td><?= esc($user['first_name']) . ' ' . esc($user['last_name']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= esc($user['gender']) ?></td>
                <td><?= esc($user['role']) ?></td>
            </tr>

        <?php endforeach; ?>

    <?php else : ?>

        <h3>No Users</h3>

        <p>Unable to find any users for you.</p>

    <?php endif; ?>
    <?php echo view('templates/footer'); ?>