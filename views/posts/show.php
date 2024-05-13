

<div class="return">
  <a href="/"><i class='bx bx-arrow-back'></i></a>
</div>
<div class="showpost">
  <div class="show">
    <a href="/users/show/id:<?= $data["user_id"]; ?>">
      <div class="user_card">
        <i class='bx bxs-user-voice'></i>
        <div class="data">
          <p class="#"><?= $data["username"] ?></p>
          <p><?= $data["email"] ?></p>
        </div>
        <button><i class='bx bx-dots-horizontal-rounded'></i></button>
      </div>
    </a>
    <div class="line"></div>
    <div>
      <h2><?= $data["title"] ?></h2>
      <p><?= $data["description"] ?></p>
      <div class="images">
        <?php foreach ($data["images"] as $image): ?>
          <div class="image">
            <img src="/assets/imgs/<?= $image["image"] ?>" alt='Image from "<?= $data["title"] ?>"'>
          </div>
        <?php endforeach; ?>
      </div>
      <?php if(isset($_SESSION['user']['id'])): ?>
        <div class="all-reaction" id="react_<?php echo $data["id"]?>">
          <img src="/resources/img/thumb.gif" class="reaction" id="thumb_<?php echo $data["id"]?>"> 
          <img src="/resources/img/haha.gif" class="reaction" id="haha_<?php echo $data["id"]?>">
          <img src="/resources/img/love.gif" class="reaction" id="love_<?php echo $data["id"]?>">
          <img src="/resources/img/wow.gif" class="reaction" id="wow_<?php echo $data["id"]?>">
          <img src="/resources/img/sad.gif" class="reaction" id="sad_<?php echo $data["id"]?>">
          <img src="/resources/img/angry.gif" class="reaction" id="angry_<?php echo $data["id"]?>">
        </div>
      <?php endif; ?>
      <div class="actions-show">
        <div class="react-con" align="center" id="<?php echo $data["id"];?>">
          <?php if ($data['total_reactions'] > 0 || isset($_SESSION['user']['id'])): ?>
            <?php if (isset($_SESSION['user']['id']) && !empty($data['user_reactions'])): ?>
              <img src="/resources/img/<?php echo $data['user_reactions'];?>.png" class="reaction">
            <?php else: ?>
              <p><i class='bx bxs-like' onclick='app.checkSession()'></i></p>
            <?php endif; ?>
          <?php else: ?>
              <p><i class='bx bxs-like' onclick='app.checkSession()'></i></p>
          <?php endif; ?>
        </div>
        <br>
        <i class="likes <?= isset($_SESSION['user']) ? '' : 'openModal' ?>" id="reactions-count-<?= $data['id'] ?>">
          <img src="/resources/img/like.png" alt="like"> reactions: <?= $data['total_reactions'] ?? 0 ?>
        </i>
        <i class='bx bx-show'></i>
        <p>244k</p>
        <p class="date-create"><?= $data["created_at"] ?></p>
      </div>
    </div>
  </div>
</div>
<div class="main_comments">
  <div class="count_comments">
    <i class='bx bxs-chat'></i>
    <p>243k Comments</p>
    <button><i class='bx bx-dots-horizontal-rounded'></i></button>
  </div>
  <div class="line"></div>
  <div class="all_comments">
    <div class="user_card">
      <i class='bx bxs-user-voice'></i>
      <div class="data">
        <h3>Comments</h3>
      </div>
    </div>
    <?php if (isset($_SESSION['user'])): ?>
      <form action="/posts/create_comment_father" method="post">
        <div class="comment-user">
          <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
          <input type="hidden" name="post_id" value="<?= $data["id"]; ?>">
          <textarea name="comment" placeholder="Write Comment" oninput="autoSize(this)" rows="1"></textarea>
          <button type="submit">
            <i class='bx bxs-paper-plane'></i>
          </button>
        </div>
      </form>
    <?php else: ?>
      <p>Please log in to leave a comment</p>
    <?php endif; ?>
    <p id="comments"></p>
    
    <script>
      var postId = <?= $data["id"] ?>;
      var userId = <?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null' ?>;
    </script>
    <script src="/resources/js/comments.js"></script>
    <script src="/resources/js/reaction.js"></script>
  </div>
</div>
