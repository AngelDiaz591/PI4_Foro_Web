<?php 
include_once LAYOUTS . 'header.php';

get_header($data);
$id = as_object($data)->id;
?>

<h1>Edit Post</h1>
<form method="post" id="edit-form" onsubmit="posts.update_post(event, this)" novalidate>
  <input type="hidden" name="id" id="id" value="<?= $id ?>">
  <div class="field">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" placeholder="Amazing Title" required>
  </div>
  <div class="field">
    <label for="body">Body</label>
    <textarea name="body" id="body" placeholder="This is an amazing post"
      cols="30" rows="10"></textarea>
  </div>
  <div class="actions">
    <input type="submit" name="submit" id="submit" value="Update Post">
  </div>
</form>
<a href="/">Back to home</a>

<?php
include_once LAYOUTS . 'footer.php';

get_footer($data, 'posts.js', 'errors.js', 'app.js');
end_footer();
?>
