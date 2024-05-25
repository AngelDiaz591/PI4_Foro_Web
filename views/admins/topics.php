<div class="body_wrapper">
    <br>
    <h1>THEMES</h1>
    <table class="content-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Username</th>
                <th>Title</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <p class="profile-card"><p><?= $d["username"] ?></p> .</p>
            </tr>
            <?php foreach ($data->data as $row): ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->created_at; ?></td>
                    <td><?= $row->username; ?></td>
                    <td><?= $row->title; ?></td>
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
