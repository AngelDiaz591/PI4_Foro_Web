<div class="return">
  <a href="/"><i class='bx bx-arrow-back' ></i></a>
</div>
<div class="showpost">
  <div class="show">
    <a href="/users/show/id:<?= $params["user_id"]; ?>">
      <div class="user_card">
        <i class='bx bxs-user-voice'></i>
        <div class="data">
          <p class="#"><?= $params["username"] ?></p>
          <p><?= $params["email"] ?></p>
        </div>
        <button><i class='bx bx-dots-horizontal-rounded' ></i></button>
      </div>
    </a>

    <div class="line"></div>

    <div>
      <h2><?= $params["title"] ?></h2>
      <p><?= $params["description"] ?></p>
      <div class="images">
        <?php foreach ($params["images"] as $image): ?>
          <div class="image">
            <img src="<?= IMAGES . $image["image"] ?>" alt='Image from "<?= $params["title"] ?>"'>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="actions-show">
        <i class='bx bxs-like'></i>
        <p>243K</p>
        <i class='bx bx-show'></i>
        <p>244k</p>
        <p class="date-create"><?= $params["created_at"] ?></p>
      </div>
    </div>
  </div>
</div>
<div class="main_comments">
  <div class="count_comments">
    <i class='bx bxs-chat'></i>
    <p>243k Comments</p>
    <button><i class='bx bx-dots-horizontal-rounded' ></i></button>
  </div>
  <div class="line"></div>
  <div class="all_comments">
    <div class="user_card">
      <i class='bx bxs-user-voice'></i>
      <div class="data">
        <H3>Comments </H3>
      </div>
    </div>
    <form action="/posts/create_comment_father" method="post">
      <div class="comment-user">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
        <input type="hidden" name="post_id" value="<?= $params["id"]; ?>">
        <textarea name="comment" placeholder="Write Comment" oninput="autoSize(this)" low="1"id=""></textarea>
        <button type="submit" class=<?= isset($_SESSION['user']) ? '' : 'openModal' ?>>
          <i class='bx bxs-paper-plane'></i>
        </button>
      </div>
    </form>
    <div class="all_comments">
    <?php foreach ($params["comments"] as $comment): ?>
        <div class="comment">
            <div class="user_card">
                <i class='bx bxs-user-voice'></i>
                <div class="data">
                    <p><?= $comment["username"] ?></p>
                </div>
            </div>
            <p><?= $comment["comment"] ?></p>
            <p class="date-create"><?= $comment["created_at"] ?></p>
        </div>
    <?php endforeach; ?>
</div>
  </div>
</div>
