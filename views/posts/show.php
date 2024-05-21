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
      <div class="images" onclick="openShowModal(<?= $data['id'] ?>)">
        <?php if (!empty($data["images"])): ?>
          <div class="image">
            <img src="/assets/imgs/<?= $data["images"][0]["image"] ?>" alt='Image from "<?= $data["title"] ?>"'>
            <?php if (count($data["images"]) > 1): ?>
              <div class="image-overlay">+<?= count($data["images"]) - 1 ?></div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div id="showModal-<?= $data["id"] ?>" class="show-modal">
  <span class="show-close" onclick="closeShowModal(<?= $data["id"] ?>)">&times;</span>
  <div class="show-modal-content">
    <h1 style="color: white;"><?= $data["title"] ?></h1>
    <p style="color: white;"><?= $data["description"] ?></p>
    <br>
    <div class="show-carousel-container" id="showCarouselContainer-<?= $data["id"] ?>">
      <?php foreach ($data["images"] as $image): ?>
        <div class="show-carousel-slide">
          <img src="/assets/imgs/<?= $image["image"] ?>" class="show-carousel-image" alt='Image from "<?= $data["title"] ?>"'>
        </div>
      <?php endforeach; ?>
    </div>
    <?php if (count($data["images"]) > 1): ?>
      <a class="show-prev" onclick="changeShowSlide(-1, <?= $data['id'] ?>)">&#10094;</a>
      <a class="show-next" onclick="changeShowSlide(1, <?= $data['id'] ?>)">&#10095;</a>
    <?php endif; ?>
  </div>
</div>

<!-- Comments Section -->
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
    <script>
      var postId = <?= $data["id"] ?>;
      var userId = <?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null' ?>;
    </script>
    <script src="/resources/js/comments.js"></script>
    <script src="/resources/js/reaction.js"></script>
    <script src="/resources/js/carousel.js"></script>
  </div>
  <br>
  <div class="all_comments">
    <p id="comments"></p>
  </div>
  <br>
</div>
