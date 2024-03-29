<div class="main">
  <h1>New Post</h1>
  <form action="<?= redirect_to('posts', 'create'); ?>" method="post" enctype="multipart/form-data">
    <div class="box">
      <div class="user">
        <div class="user__avatar">
          <i class="bi bi-person-circle"></i>
          <h2>Majorixch</h2>
        </div>
        <div class="user__date">
          <p class="date"><?= date('Y/m/d') ?></p>
        </div>
      </div>
      <div class="line"></div>
      <div class="text">
        <div class="field">
          <input type="text" name="title" id="title" placeholder="A example of a title" required>
        </div>
        <div class="field">
          <i class="bi bi-paperclip attach-file"></i>
          <textarea name="description" id="description" cols="30" rows="10"
            placeholder="Your thoughts go here..."></textarea>
        </div>
      </div>
      <div class="images">
        <input type="file" name="images[]" id="images" accept="image/jpg, image/jpeg, image/png, image/gif" multiple>
        <p id="extra-files"></p>
      </div>
      <div class="line"></div>
    </div>
    <div class="btn-container">
      <button type="submit" class="btn">Create</button>
    </div>
  </form>
</div>
<div class="back">
  <a href="<?= redirect_to('posts', 'index'); ?>"><i class='bx bx-arrow-back' ></i></a>
</div>
<?= script_tag('post') ?>
