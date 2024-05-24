<div class="main">
    <h2>Admins</h2>
    <table class="content-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Status</th>
                <th>Role</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->data as $row): ?>
                <?php if ($row->rol == 0): // Admins ?>
                    <tr>
                        <td><?= $row->id; ?></td>
                        <td><?= $row->username; ?></td>
                        <td>
                            <?= $row->ban == 0 ? 'unban' : 'ban'; ?>
                        </td>
                        <td>admin</td>
                        <td>
                            <button class="buttonGreen" type="button" onclick="showDeleteConfirmation(<?= $row->id; ?>)">
                                <span class="text"><i class="bi bi-archive-fill"></i>Delete</span>
                            </button>
                            <button class="buttonRed" type="button">
                                <a href="/admins/user_ban/?id=<?= $row->id; ?>"> 
                                    <span class="text"><i class="bi bi-star-fill"></i>ban</span>
                                </a>
                            </button>
                            <button class="buttonBlue" type="button">
                                <a href="/admins/user_unban/?id=<?= $row->id; ?>"> 
                                    <span class="text"><i class="bi bi-star-fill"></i>unban</span>
                                </a>
                            </button>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?> 
        </tbody>
    </table>

    <h2>Users</h2>
    <table class="content-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Status</th>
                <th>Role</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->data as $row): ?>
                <?php if ($row->rol == 1): // Users ?>
                    <tr>
                        <td><?= $row->id; ?></td>
                        <td><?= $row->username; ?></td>
                        <td>
                            <?= $row->ban == 0 ? 'unban' : 'ban'; ?>
                        </td>
                        <td>user</td>
                        <td>
                            <button class="buttonGreen" type="button" onclick="showDeleteConfirmation(<?= $row->id; ?>)">
                                <span class="text"><i class="bi bi-archive-fill"></i>Delete</span>
                            </button>
                            <button class="buttonRed" type="button">
                                <a href="/admins/user_ban/?id=<?= $row->id; ?>"> 
                                    <span class="text"><i class="bi bi-star-fill"></i>ban</span>
                                </a>
                            </button>
                            <button class="buttonBlue" type="button">
                                <a href="/admins/user_unban/?id=<?= $row->id; ?>"> 
                                    <span class="text"><i class="bi bi-star-fill"></i>unban</span>
                                </a>
                            </button>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?> 
        </tbody>
    </table>

    <script src="/resources/js/useradmin.js"></script>
</div>
