<div class="body_wrapper">
    <br>
    <h1>THEMES</h1>
    <table class="content-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Theme</th>
                <th>icon</th>
                <th>Date</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->data as $row): ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->theme; ?></td>
                    <td><i class="<?= $row->icon; ?>"></i></td>
                    <td><?= $row->created_at; ?></td>
                    <td>
                        <button class="buttonGreen" type="button">
                            <span class="text"><i class="bi bi-archive-fill"></i></span>
                        </button>
                        <button class="buttonRed" type="button">
                            <span class="text"><i class="bi bi-star-fill"></i></span>
                        </button>
                        <button class="buttonBlue" type="button">
                            <span class="text"><i class="bi bi-star-fill"></i></span>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>
</div>
