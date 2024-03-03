<div>
  <h1>Post <?= $params["id"] ?></h1>
  <div>
    <h2><?= $params["title"] ?></h2>
    <p><?= $params["description"] ?></p>
    <div class="images">
      <?php foreach ($params["images"] as $image): ?>
        <img src="<?= get_home_url() . "assets/imgs/" . $image["image"] ?>" alt='Image from "<?= $params["title"] ?>"'>
      <?php endforeach; ?>
    </div>
  </div>
  <a href="<?= redirect_to('posts', 'index'); ?>">Back</a>
</div>

