<?php
include_once LAYOUTS . 'header.php';

get_header($data);
?>
<h1>Create a new post</h1>
<form method="post" onsubmit="posts.create_post(event, this)" novalidate>
  <div class="field">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" placeholder="Amazing Title" required>
  </div>
  <div class="field">
    <label for="body">Body</label>
    <textarea name="body" id="body" placeholder="This is an amazing post" cols="30" rows="10"></textarea>
  </div>
  <div class="actions">
    <input type="submit" name="submit" id="submit" value="Create Post">
  </div>
</form>
<a href="/">Back to home</a>

<?php
include_once LAYOUTS . 'footer.php';

get_footer($data, 'posts.js', 'errors.js', 'app.js');
end_footer();
?>
