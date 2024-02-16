<div>
  <h1>Edit Post</h1>
  <form action="<?= redirect_to('posts', 'patch'); ?>" method="post">
    <input type="hidden" name="id" value="<?= $params["id"]; ?>">
    <div>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" placeholder="Title" value="<?= $params["title"]; ?>" required>
    </div>
    <div>
      <label for="description">Description</label>
      <input type="text" name="description" id="description" placeholder="Description" value="<?= $params["description"]; ?>" required>
    </div>
    <div>
      <button type="submit">Edit</button>
    </div>
  </form>
  <a href="<?= redirect_to('posts', 'index'); ?>">Back</a>
</div>

