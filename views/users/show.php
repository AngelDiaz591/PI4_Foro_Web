<div class="first-main">
  <div class="state">
    <div class="cover-profile">
    </div>
  </div>
  <div class="state2">
    <div class="info-user">
      <div class="position">
        <div>
            <img src="/resources/img/login.svg" alt="photo" class="photo">
        </div>
        <div class="data-user">
          <div class="username">
              <h1><?= $data->username ?></h1>
              <p class="ig">@LupitaNieves</p>
          </div>
          <div class="count">
            <a class="caract" onclick="user.followers(event)">
              <h3 class="ig"><?= $data->followers ?></h3>
              <h3>Followers</h3>
              <div id="followers-container"></div> 
            </a>
            <a class="caract" onclick="user.following(event)">
              <h3 class="ig"><?= $data->following ?></h3>
              <h3>Following</h3>
              <div id="following-container"></div>
            </a>
            <div class="caract">
              <h3 class="ig"><?= $data->posts ?></h3>
              <h3>Post</h3>
            </div>
          </div>
        </div>

        <div class="follow-container">
          <?php if ($data->follower): ?>
            <form onsubmit="user.unfollow(event, this)">
              <input type="hidden" name="user_id" value="<?= $data->id ?>">
              <input type="hidden" name="follower_id" value="<?= $_SESSION['user']['id'] ?>">
              <button type="submit">Unfollow</button>
            </form>
          <?php elseif ($data->id != $_SESSION['user']['id']): ?>
            <form onsubmit="user.follow(event, this)">
              <input type="hidden" name="user_id" value="<?= $data->id ?>">
              <input type="hidden" name="follower_id" value="<?= $_SESSION['user']['id'] ?>">
              <button type="submit">Follow</button>
            </form>
          <?php endif; ?>
        </div>

        <div class="edit-btn">
          <a href="#" class="btn-conf">
            <i class="bi bi-gear-fill sh-icon"></i> Edit Profile
          </a>
        </div>
      </div>
      <div class="submenu">
        <a class="option" href="#section-post">Post</a>
        <a class="option" href="#section-media">Media</a>
        <a class="option" href="#section-comments">Comments</a>
      </div>
    </div>
  </div>
  <div class="profile">
    <div class="hobbies">
      <div class="info">
        <h3>LIFE BITS</h3>
        <div class="datas">
          <h4 class="sh"><i class="bi bi-calendar3 sh-icon"></i>Joined <?= $data->created_at ?></h4>
          <h4 class="sh"><i class="bi bi-geo-alt-fill sh-icon"></i> 742 Evergreen Terrace</h4>
          <a class="link"><i class="bi bi-plus-lg"></i> Add a description about you</a>
          <a class="link"><i class="bi bi-plus-lg"></i> Add your social networks</a>
        </div>
      </div>
    </div>
    <div>
    </div>
  </div>
</div>

<script src="/resources/js/user.js"></script>
