<div class="postbox">
  <div class="chats">
    <div class="box">
      <h2>POPULAR CHART</h2>
      <div class="line"></div>
      <div class="chat">
        <?= img_tag('logo.png', 'logo', 'perfil') ?>
        <div class="info">
          <p class="name">Gaelblack</p>
          <p class="followers">255 followers</p>
        </div>
        <button action="submit" class="action">
          <p>JOIN</p>
        </button>
      </div>
      <div class="chat">
        <?= img_tag('logo.png', 'logo', 'perfil') ?>
        <div class="info">
          <p class="name">Gaelblack</p>
          <p class="followers">255 followers</p>
        </div>
        <button action="submit" class="action">
          <p>JOIN</p>
        </button>
      </div>
      <div class="chat">
        <?= img_tag('logo.png', 'logo', 'perfil') ?>
        <div class="info">
          <p class="name">Gaelblack</p>
          <p class="followers">255 followers</p>
        </div>
        <button action="submit" class="action">
          <p>JOIN</p>
        </button>
      </div>
      <br>
      <h4 class="action">VIEW MORE</h4>
    </div>
  </div>
  <?php if(!isset($_SESSION['user'])): ?>
    <div class="register-box">
      <h1>JOIN OUR ONLINE COMMUNITY</h1>
      <br>
      <p>Come join this community and add you two cents!</p>
      <div class="button">
        <a href="<?= redirect_to('registrations', 'new'); ?>">SIGN UP</a>
        <i class='bx bxs-log-in'></i>
      </div>
    </div>
  <?php endif; ?>
</div>
