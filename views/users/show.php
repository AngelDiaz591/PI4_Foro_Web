
<div class="header__wrapper">
      <header></header>
      <div class="cols__container">
        <div class="left__col">
          <div class="img__container">
            <img src="/resources/img/user.jpeg" alt="Anna Smith" />
          </div>
          <p class="username"><?= $data->username ?></p>
          <p>Joined <?= $data->created_at ?></p>
          <p>anna@example.com</p>
          <div class="edit-btn">
            <a id="openModal1" class="btn-conf">
              <i class="bi bi-gear-fill sh-icon"></i> Edit Profile
            </a>
          </div>
          <ul class="about">
            <li><span><?= $data->followers ?></span>Followers</li>
            <li><span><?= $data->following ?></span>Following</li>
            <li><span><?= $data->posts ?></span>Post</li>
          </ul>
          <div class="contents">
            <p></p>
          </div>
        </div>
        <div class="right__col">
          <div class="menu-user">
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
            <ul>
              <li><a class="option" id="section-post">POSTS</a></li>
              <li><a class="option" id="section-media">MEDIA</a></li>
              <li><a class="option" id="section-comments">COMMENTS</a></li>
            </ul>
          </div>

          <section id="postsSection" class="section">
            <div class="photos">
                <img src="/resources/img/img_1.avif" alt="Photo" />
                <img src="/resources/img/img_2.avif" alt="Photo" />
                <img src="/resources/img/img_4.avif" alt="Photo" />
                <img src="/resources/img/img_5.avif" alt="Photo" />
                <img src="/resources/img/img_6.avif" alt="Photo" />
              </div>
          </section>

          <section id="mediaSection" class="section" style="display: none;">
            <div class="photos">
              <img src="/resources/img/img_1.avif" alt="Photo" />
              <img src="/resources/img/img_2.avif" alt="Photo" />
              <img src="/resources/img/img_3.avif" alt="Photo" />
              <img src="/resources/img/img_4.avif" alt="Photo" />
              <img src="/resources/img/img_5.avif" alt="Photo" />
              <img src="/resources/img/img_6.avif" alt="Photo" />
            </div>
          </section>

          <section id="commentsSection" class="section" style="display: none;">
          <div class="photos">
              <img src="/resources/img/img_1.avif" alt="Photo" />
              <img src="/resources/img/img_2.avif" alt="Photo" />
              <img src="/resources/img/img_4.avif" alt="Photo" />
              <img src="/resources/img/img_6.avif" alt="Photo" />
            </div>
          </section>
        </div>
      </div>
    </div>
    
    <div id="modal1" class="modals">
      <div class="modal-contents">
      <span class="closes">&times;</span>
      <p>Edit profile</p>
      <p class="instruction-modal">Photo portail</p>
        <div class="photo_portail">
          <img src="/resources/img/bg.jpeg" id="portailImage"/>
          <div class="change-images">
            <button id="changeImagePortail">
              <i class="bi bi-camera-fill"></i> Change image
            </button>
            <input type="file" id="filePortail" accept="image/*">
          </div>
        </div>
      <div class="principal-form">
      <p class="instruction-modal">Photo profile</p>
        <div class="left-form">
          <form id="form1">
            <div class="photo_profile">
              <img src="/resources/img/user.jpeg" id="profileImage"/>
              <div class="change-images">
              <button id="changeImageProfile">
              <i class="bi bi-camera-fill"></i>
              </button>
              <input type="file" id="fileProfile" accept="image/*">
            </div>
          </div>
      </div>
      <div class="right-form">
        <p class="instruction-modal">Basic Information</p>
        <div class="user-input">
          <label for="name1">Username</label>
          <input class="profile_input "type="text" id="" name="">
        </div>
        <div class="user-input">
          <label for="email1">About you</label>
          <textarea name="" id="" cols="30" rows="5" class="description_user"></textarea>
        </div>
      </form>
      </div>
      </div>
      <div class="action-forms">
        <button class="cancel-btn" type="button" id="">Cancel changes</button>
        <button class="save-btn" type="button" id="">Save changes</button>
      </div>
    </div>
  </div>
<script src="/resources/js/user.js"></script>
