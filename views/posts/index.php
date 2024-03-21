<div class="main">
  <h1>All Posts</h1>
  <a href="<?= redirect_to('posts', 'new'); ?>">New</a>
  <?php foreach ($data as $d): ?>
    <a href="<?= redirect_to('posts', 'show') . '&id=' . $d["id"]; ?>">
      <div class="box">
        <div class="user">
          <div class="user__avatar">
            <i class="bi bi-person-circle"></i>
            <h2>Majorixch</h2>
          </div>
          <div class="user__date">
            <p class="date"><?= date('Y/m/d', strtotime($d["created_at"])) ?></p>
          </div>
        </div>
        <div class="line"></div>
        <div class="text">
          <h3><?= $d["title"] ?></h3>
          <p class="hidden"><?= $d["description"] ?></p>
          <p class="read-more-btn hidden_">Ver más...</p>
          <p class="read-less-btn hidden_">Ver menos...</p>
        </div>
        <div class="box__images post-index">
          <?php foreach ($d["images"] as $index => $image): ?>
            <img src="<?= get_home_url() . "assets/imgs/" . $image["image"] ?>" alt='Image from "<?= $d["title"] ?>"'>
          <?php endforeach; ?>
        </div>
        <div>
          <div class="actions">
            <p><i class="bi bi-trophy"></i>243K</p>
            <p><i class="bi bi-eye"></i>243K</p>
            <p><i class="bi bi-chat-left-text"></i>243K</p>
          </div>
          <a href="<?= redirect_to('posts', 'edit') . '&id=' . $d["id"]; ?>">Edit</a>
          <a href="<?= redirect_to('posts', 'delete') . '&id=' . $d["id"]; ?>">Delete</a>
        </div>
      </div>
    </a>
  <?php endforeach; ?>
</div>
