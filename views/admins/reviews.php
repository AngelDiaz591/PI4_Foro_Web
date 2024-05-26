<div class="body_wrapper">
    <br>
    <h1>REVIEW of PUBLICATIONS</h1>
    <table class="content-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Username</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->data as $row): ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->created_at; ?></td>
                    <td><?= $row->username; ?></td>
                    <td><?= $row->title; ?></td>
                    <td>
                        <button class="buttonGreen" onclick="app.reviewPosts(<?= $row->id ?>)">
                            <span class="text"><i class="bi bi-archive-fill"></i></span>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>
</div>
