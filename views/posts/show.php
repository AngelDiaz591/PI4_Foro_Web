<div>
  <h1>Post <?= $params["id"] ?></h1>
  <div>
    <h2><?= $params["title"] ?></h2>
    <p><?= $params["description"] ?></p>
  </div>
  <a href="<?= redirect_to('posts', 'index'); ?>">Back</a>
</div>

