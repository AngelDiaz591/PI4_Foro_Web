<div class="main">
  <h1>All Posts</h1>
  <a href="<?= redirect_to('posts', 'new'); ?>">New</a>
  <?php foreach ($data as $d): ?>
    <div class="box">
      <div class="user">
        <span class="material-symbols-outlined">person</span>
        <p class="profile">Majorixch .</p>
        <p class="date"><?= $d['created_at'] ?></p>
      </div>
      <div class="line"></div>
      <div class="text">
        <h2><?= $d["title"] ?></h2>
        <p class="hidden"><?= $d["description"] ?></p>
        <p class="read-more-btn hidden_">Ver más...</p>
        <p class="read-less-btn hidden_">Ver menos...</p>
      </div>
      <div class="images">
        <?php foreach ($d["images"] as $image): ?>
          <img src="<?= get_home_url() . "assets/imgs/" . $image["image"] ?>" alt='Image from "<?= $d["title"] ?>"'>
        <?php endforeach; ?>
      </div>
      <div>
        <div class="actions">
          <p><span class="material-symbols-outlined">emoji_events</span>
            243K
          </p>
          <p><span class="material-symbols-outlined">visibility</span>
            243K
          </p>
          <p><span class="material-symbols-outlined">Comment</span>
            243K
          </p>
          <a href="<?= redirect_to('posts', 'show') . '&id=' . $d["id"]; ?>">Show</a>
          <a href="<?= redirect_to('posts', 'edit') . '&id=' . $d["id"]; ?>">Edit</a>
          <a href="<?= redirect_to('posts', 'delete') . '&id=' . $d["id"]; ?>">Delete</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
