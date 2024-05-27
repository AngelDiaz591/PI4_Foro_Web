<div class="body_wrapper">
    <h1>USERS MANAGEMENT</h1>
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
                <?php if ($row->rol == 0 && $row->id != $_SESSION['user']['id']):?>
                    <tr>
                        <td><?= $row->id; ?></td>
                        <td><?= $row->username; ?></td>
                        <td>
                            <?= $row->ban == 0 ? 'unban' : 'ban'; ?>
                        </td>
                        <td>admin</td>
                        <td class="content-table-actions">
                            <form method="POST" action="/admins/user_delete" onsubmit="return confirmDelete();">
                                <input type="hidden" value="<?= $row->id; ?>" name="id" id="id-<?= $row->id; ?>">
                                <button class="buttonGreen" type="submit">
                                    <span class="text"><i class="bi bi-archive-fill"></i>Delete</span>
                                </button>
                            </form>    
                            <form method="POST" action="/admins/user_ban">
                                <input type="hidden" value="<?= $row->id; ?>" name="id" id="id-<?= $row->id; ?>">
                                <button class="buttonRed" type="submit">
                                    <span class="text"><i class="bi bi-star-fill"></i>ban</span>
                                </button>
                            </form>
                            <form method="POST" action="/admins/user_unban">
                                <input type="hidden" value="<?= $row->id; ?>" name="id" id="id-<?= $row->id; ?>">
                                <button class="buttonBlue" type="submit">
                                    <span class="text"><i class="bi bi-star-fill"></i>unban</span>
                                </button>
                            </form>
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
                <?php if ($row->rol == 1 && $row->id != $_SESSION['user']['id']): // Users excluding current user ?>
                    <tr>
                        <td><?= $row->id; ?></td>
                        <td><?= $row->username; ?></td>
                        <td>
                            <?= $row->ban == 0 ? 'unban' : 'ban'; ?>
                        </td>
                        <td>user</td>
                        <td class="content-table-actions">
                            <form method="POST" action="/admins/user_delete" onsubmit="return confirmDelete();">
                                <input type="hidden" value="<?= $row->id; ?>" name="id" id="id-<?= $row->id; ?>">
                                <button class="buttonGreen" type="submit">
                                    <span class="text"><i class="bi bi-archive-fill"></i>Delete</span>
                                </button>
                            </form> 
                            <form method="POST" action="/admins/user_ban">
                                <input type="hidden" value="<?= $row->id; ?>" name="id" id="id-<?= $row->id; ?>">
                                <button class="buttonRed" type="submit">
                                    <span class="text"><i class="bi bi-star-fill"></i>ban</span>
                                </button>
                            </form>
                            <form method="POST" action="/admins/user_unban">
                                <input type="hidden" value="<?= $row->id; ?>" name="id" id="id-<?= $row->id; ?>">
                                <button class="buttonBlue" type="submit">
                                    <span class="text"><i class="bi bi-star-fill"></i>unban</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?> 
        </tbody>
    </table>
    <script src="/resources/js/useradmin.js"></script>
</div>
