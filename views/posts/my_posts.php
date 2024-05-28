<div class="body_wrapper">
    <br>
    <h1>REVIEW OF PUBLICATIONS</h1>

    <!-- Posts Under Review -->
    <h2>Posts Under Review</h2>
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
                            <button class="buttonRed" onclick="window.location.href='/posts/edit/id:<?= $row['id']; ?>'">
                                <span class="text"><i class="bi bi-pencil"></i></span>
                            </button>
                            <form method="POST" action="/posts/drop" onsubmit="return confirmDeletePost();">
                                <input type="hidden" value="<?= $row['id']; ?>" name="id" id="id-<?= $row['id']; ?>">
                                <button class="buttonBlue" type="submit">
                                    <span class="text"><i class="bi bi-trash"></i></span>
                                </button>
                            </form> 
                        </td>
                    </tr>
                <?php endif; ?> 
            <?php endforeach; ?> 
        </tbody>
    </table>

    <!-- Rejected Posts -->
    <h2>Rejected Posts</h2>
    <table class="content-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Username</th>
                <th>Title</th>
                <th>Reason</th>
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
                        <td><?= $row['reason']; ?></td>
                        <td>
                            <button class="buttonGreen" onclick="app.reviewPosts(<?= $row['id'] ?>)">
                                <span class="text"><i class="bi bi-archive-fill"></i></span>
                            </button>
                            <button class="buttonRed" onclick="window.location.href='/posts/edit/id:<?= $row['id']; ?>'">
                                <span class="text"><i class="bi bi-pencil"></i></span>
                            </button>
                            <form method="POST" action="/posts/drop" onsubmit="return confirmDeletePost();">
                                <input type="hidden" value="<?= $row['id']; ?>" name="id" id="id-<?= $row['id']; ?>">
                                <button class="buttonBlue" type="submit">
                                    <span class="text"><i class="bi bi-trash"></i></span>
                                </button>
                            </form> 
                        </td>
                    </tr>
                <?php endif; ?> 
            <?php endforeach; ?> 
        </tbody>
    </table>

    <!-- Accepted Posts -->
    <h2>Accepted Posts</h2>
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
                <?php if ($row['permission'] == 3): ?> 
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['created_at']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['title']; ?></td>
                        <td>
                            <button class="buttonGreen" onclick="app.reviewPosts(<?= $row['id'] ?>)">
                                <span class="text"><i class="bi bi-archive-fill"></i></span>
                            </button>
                            <button class="buttonRed" onclick="window.location.href='/posts/edit/id:<?= $row['id']; ?>'">
                                <span class="text"><i class="bi bi-pencil"></i></span>
                            </button>
                            
                            <form method="POST" action="/posts/drop" onsubmit="return confirmDeletePost();">
                                <input type="hidden" value="<?= $row['id']; ?>" name="id" id="id-<?= $row['id']; ?>">
                                <button class="buttonBlue" type="submit">
                                    <span class="text"><i class="bi bi-trash"></i></span>
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
