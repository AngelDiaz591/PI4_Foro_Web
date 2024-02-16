<div>
  <h1>New Post</h1>
  <form action="<?= redirect_to('posts', 'create'); ?>" method="post">
    <div>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" placeholder="Title" required>
    </div>
    <div>
      <label for="description">Description</label>
      <input type="text" name="description" id="description" placeholder="Description" required>
    </div>
    <div>
      <button type="submit">Create</button>
    </div>
  </form>
  <a href="<?= redirect_to('posts', 'index'); ?>">Back</a>
</div>

