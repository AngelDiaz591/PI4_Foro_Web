<div>
  <h1>Edit Post</h1>
  <form action="<?= redirect_to('posts', 'patch'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $params["id"]; ?>">
    <div>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" placeholder="Title" value="<?= $params["title"]; ?>" required>
    </div>
    <div>
      <label for="description">Description</label>
      <input type="text" name="description" id="description" placeholder="Description" value="<?= $params["description"]; ?>" required>
    </div>
    <div class="images">
      <?php foreach ($params["images"] as $image): ?>
        <div class="image">
          <img src="<?= get_home_url() . "assets/imgs/" . $image["image"] ?>" alt='Image from "<?= $params["title"] ?>"'>
          <a href="<?= redirect_to('posts', 'purge_image') . '&id=' . $image["id"] . '&image=' . $image["image"] . '&post_id=' . $params["id"]; ?>">
            <span>&times;</span>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
    <div>
      <label for="images">Images</label>
      <input type="file" name="images[]" id="images" accept="image/jpg, image/jpeg, image/png, image/gif" multiple>
    </div>
    <div>
      <button type="submit">Edit</button>
    </div>
  </form>
  <a href="<?= redirect_to('posts', 'index'); ?>">Back</a>
</div>

