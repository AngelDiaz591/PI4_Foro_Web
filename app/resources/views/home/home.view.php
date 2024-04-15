<?php
include_once LAYOUTS . 'header.php';

get_header($data);
?>
<h1>Posts</h1>
<a href="/post/new/">New Post</a>
<div id="posts-container">

</div>

<?php
include_once LAYOUTS . 'footer.php';

get_footer($data, 'posts.js', 'errors.js', 'app.js');
end_footer();
?>
