<div class="body_wrapper">
    <br>
    <h1>REVIEW OF PUBLICATIONS</h1>
    <!-- Rejected Publications -->
    <h2>Rejected Publications</h2>
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
            <?php foreach ($data['data'] as $row): ?>
                <?php if ($row['permission'] == 1): ?> 
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['created_at']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['title']; ?></td>
                        <td>
                            <button class="buttonGreen" onclick="app.reviewPosts(<?= $row['id'] ?>)">
                                <span class="text"><i class="bi bi-archive-fill"></i></span>
                            </button>
                            <button class="buttonRed">
                               <a href="/posts/edit/id:<?= $row['id']; ?>">
                                <span class="text"><i class="bi bi-pencil"></i></span>
                            </button>

                        </td>
                    </tr>
                <?php endif; ?> 
            <?php endforeach; ?> 
        </tbody>
    </table>
    
    <!-- Accepted Publications -->
    <h2>Accepted Publications</h2>
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
            <?php foreach ($data['data'] as $row): ?>
                <?php if ($row['permission'] == 2): ?> 
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['created_at']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['title']; ?></td>
                        <td>
                            <button class="buttonGreen" onclick="app.reviewPosts(<?= $row['id'] ?>)">
                                <span class="text"><i class="bi bi-archive-fill"></i></span>
                            </button>
                            <button class="buttonRed">
                               <a href="/posts/edit/id:<?= $row['id']; ?>">
                                <span class="text"><i class="bi bi-pencil"></i></span>
                            </button>
                        </td>
                    </tr>
                <?php endif; ?> 
            <?php endforeach; ?> 
        </tbody>
    </table>
</div>