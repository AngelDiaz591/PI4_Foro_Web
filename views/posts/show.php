<div class="main">
  <div class="box">
    <div class="user">
      <span class="material-symbols-outlined">person</span>
      <p>Majorixch .</p>
      <p class="date"><?= date('Y/m/d', strtotime($params["created_at"])) ?></p>
    </div>
    <div class="line"></div>
    <div class="text">
      <h2><?= $params["title"] ?></h2>
      <p><?= $params["description"] ?></p>
      <p class="read-more-btn hidden_">Ver más...</p>
      <p class="read-less-btn hidden_">Ver menos...</p>
    </div>
    <div class="box__images">
      <?php foreach ($params["images"] as $image): ?>
        <img src="<?= get_home_url() . "assets/imgs/" . $image["image"] ?>" alt='Image from "<?= $params["title"] ?>"'>
      <?php endforeach; ?>
    </div>
    <div class="actions">
      <p><i class="bi bi-trophy"></i>243K</p>
      <p><i class="bi bi-eye"></i>243K</p>
      <p><i class="bi bi-chat-left-text"></i>243K</p>
    </div>
  </div>
</div>
<a href="<?= redirect_to('posts', 'index'); ?>" class="return">
  <i class="bi bi-arrow-left"></i>
</a>

