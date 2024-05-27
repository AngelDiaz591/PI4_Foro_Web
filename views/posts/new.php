<div class="main">
  <h1>New Post</h1>
  <form action="/posts/create" method="post" enctype="multipart/form-data">
    <div class="box">
      <div class="user">
        <div class="user__avatar">
          <i class="bi bi-person-circle"></i>
          <h2><?= $_SESSION['user']['username']; ?></h2>
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
        <div class="field">
          <select name="unesco_theme_id" id="unesco_theme_id" required>
            <option value="" disabled selected>Select a theme</option>
          </select>
        </div>
        <div class="field">
          <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
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
  <a onclick="window.history.back();"><i class='bx bx-arrow-back' ></i></a>
</div>
<script src="/resources/js/post.js"></script>
