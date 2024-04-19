<?php
include_once LAYOUTS . 'header.php';

get_header($data);
$id = as_object($data)->id;
?>

<div id="post-container">
</div>
<a href="/">Back to home</a>

<?php
include_once LAYOUTS . 'footer.php';

get_footer($data, 'posts.js', 'errors.js', 'app.js');
end_footer();
?>
