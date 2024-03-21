<div class="main">
  <h1>Edit Post</h1>
  <form action="<?= redirect_to('posts', 'patch'); ?>" method="post" enctype="multipart/form-data">
    <div class="box">
      <div class="user">
        <div class="user__avatar">
          <i class="bi bi-person-circle"></i>
          <h2>Majorixch</h2>
        </div>
        <div class="user__date">
          <p class="date"><?= date('Y/m/d', strtotime($params["created_at"])) ?></p>
        </div>
      </div>
      <div class="line"></div>
      <input type="hidden" name="id" value="<?= $params["id"]; ?>">
      <div class="text">
        <div class="field">
          <input type="text" name="title" id="title" placeholder="Title" value="<?= $params["title"]; ?>" required>
        </div>
      </div>
      <div class="text">
        <div class="field">
          <i class="bi bi-paperclip attach-file"></i>
          <textarea name="description" id="description" cols="30" rows="10"
            placeholder="Your thoughts go here..."><?= $params["description"]; ?></textarea>
        </div>
      </div>
      <div class="images">
        <input type="file" name="images[]" id="images" accept="image/jpg, image/jpeg, image/png, image/gif" multiple>
        <p id="extra-files"></p>
        <?php foreach ($params["images"] as $image): ?>
          <div class="image">
            <img src="<?= get_home_url() . "assets/imgs/" . $image["image"] ?>" alt='Image from "<?= $params["title"] ?>"'>
            <a href="<?= redirect_to('posts', 'purge_image') . '&id=' . $image["id"] . '&image=' . $image["image"] . '&post_id=' . $params["id"]; ?>"
              class="remove-image">
              <span>&times;</span>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="line"></div>
    </div>
    <div class="btn-container">
      <button type="submit" class="btn">Edit</button>
    </div>
  </form>
</div>
<a href="<?= redirect_to('posts', 'index'); ?>" class="return">
  <i class="bi bi-arrow-left"></i>
</a>
<?= script_tag('post') ?>

