
<div class="header__wrapper">
      <header></header>
      <div class="cols__container">
        <div class="left__col">
          <div class="img__container">
            <img src="/resources/img/user.jpeg" alt="Anna Smith" />
          </div>
          <h2 class="username"><?= $data->username ?></h2>
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
            <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam
              erat volutpat. Morbi imperdiet, mauris ac auctor dictum, nisl
              ligula egestas nulla.
            </p>

            <a class="link" id="openModal2"><i class="bi bi-plus-lg"></i> Add a description about you</a><br>
            <a class="link"><i class="bi bi-plus-lg"></i> Add your social networks</a>
            <ul>
              <li><i class="bi bi-twitter-x"></i></li>
              <i class="fbi bi-pinterest"></i>
              <i class="bi bi-facebook"></i>
            </ul>
          </div>
        </div>
        <div class="right__col">
          <div class="menu-user">
            <button>Follow</button>
            <ul>
              <li><a class="option" href="#section-post">POSTS</a></li>
              <li><a class="option" href="#section-media">MEDIA</a></li>
              <li><a class="option" href="#section-comments">COMMENTS</a></li>
            </ul>
            <!-- <div class="follow-containers">
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
            </div> -->
            
          </div>

          <div class="photos">
            <img src="/resources/img/img_1.avif" alt="Photo" />
            <img src="/resources/img/img_2.avif" alt="Photo" />
            <img src="/resources/img/img_3.avif" alt="Photo" />
            <img src="/resources/img/img_4.avif" alt="Photo" />
            <img src="/resources/img/img_5.avif" alt="Photo" />
            <img src="/resources/img/img_6.avif" alt="Photo" />
          </div>
        </div>
      </div>
    </div>
    
    <div id="modal1" class="modals">
    <div class="modal-contents">
      <span class="closes">&times;</span>
      <p>Edit profile</p>
      <!-- <p class="instruction-modal">¡Personaliza tu perfil!</p> -->
      <form id="form1">
        <div class="user-input">
          <label for="name1">Username</label>
          <input class="profile_input "type="text" id="" name="">
        </div>
        <div class="user-input">
          <label for="email1">About you</label>
          <textarea name="" id="" cols="30" rows="5" class="description_user"></textarea>
        </div>
        <button type="button" id="submit1">Enviar</button>
      </form>
    </div>
  </div>

  <div id="modal2" class="modals">
    <div class="modal-contents">
      <span class="closes">&times;</span>
      <h3>Modal 2</h3>
      <form id="form2">
        <label for="message">Mensaje:</label>
        <textarea id="message" name="message"></textarea>
        <br><br>
        <button type="button" id="submit2">Enviar</button>
      </form>
    </div>
  </div>

<script src="/resources/js/user.js"></script>
