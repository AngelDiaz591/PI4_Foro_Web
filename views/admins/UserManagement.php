<div class="main">
    <table class="content-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Status</th>
                <th>Username</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->data as $row): ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->username; ?></td>
                    <td>
                        <?php if ($row->ban == 0): ?>
                            unban
                        <?php else: ?>
                            ban
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="buttonGreen" type="button" onclick="showDeleteConfirmation(<?= $row->id; ?>)">
                            <span class="text"><i class="bi bi-archive-fill"></i>Delete</span>
                            </button>
                        <button class="buttonRed" type="button">
                            <a href="/admins/user_ban?id=<?= $row->id; ?>"> 
                            <span class="text"><i class="bi bi-star-fill"></i>ban</span>
                             </a>
                        </button>
                        <button class="buttonBlue" type="button">
                            <a href="/admins/user_unban?id=<?= $row->id; ?>"> 
                            <span class="text"><i class="bi bi-star-fill"></i>unban</span>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>
    <script src="/resources/js/useradmin.js"></script>
</div>
