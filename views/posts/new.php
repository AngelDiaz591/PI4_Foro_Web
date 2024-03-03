<div>
  <h1>New Post</h1>
  <form action="<?= redirect_to('posts', 'create'); ?>" method="post" enctype="multipart/form-data">
    <div>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" placeholder="Title" required>
    </div>
    <div>
      <label for="description">Description</label>
      <input type="text" name="description" id="description" placeholder="Description" required>
    </div>
    <div>
      <label for="images">Images</label>
      <input type="file" name="images[]" id="images" accept="image/jpg, image/jpeg, image/png, image/gif" multiple>
    </div>
    <div>
      <button type="submit">Create</button>
    </div>
  </form>
  <a href="<?= redirect_to('posts', 'index'); ?>">Back</a>
</div>

