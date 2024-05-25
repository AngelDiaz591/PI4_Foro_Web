<header>
  <?php 
  $uri = filter_input_array(INPUT_GET)['uri'];
  if (!str_contains($uri, 'users')): ?>
    <i class='bx bx-menu menu' id="menu-icon" ></i>
  <?php endif; ?>

  <a href="/" class="logo">
    <img src="/resources/img/logo.png" alt="logo">
    <h2>CulturEdge</h2>
  </a>
  <?php
    if (!str_contains($uri, 'admins')): ?>
        <div class="seeker">
          <button id="search-button"><i class='bx bx-search-alt'></i></button>
          <input class="cont" placeholder="Search" type="search" id="search-input">
        </div>
  <?php endif; ?>

  <div class="actions">
    <?php if(isset($_SESSION['user'])): ?>
      <?php if($_SESSION['user']['rol'] === 0): ?>
        <?php if (!str_contains($uri, 'admins')): ?>
          <a href="/admins/console" class="btn-console">
            <i class='bx bx-grid-alt'></i>ADMINISTRATOR
          </a>
          <button class="btn-notifications" onclick="app.userNotificationsOpen()">
            <i class='notifications-icon bx bx-bell'></i>
            <span class="notifications-count">
              <span class="spinner spinner-red"></span>
            </span>
          </button>
        <?php else: ?>
          <a href="/" class="btn-console">
            <i class='bx bx-grid-alt'></i>USER VIEW
          </a>
        <?php endif; ?>
      <?php endif; ?>

      
      <button class="btn-userMenu" onclick="app.userMenuOpen()">
        <img src="/resources/img/user.png" alt="user">
      </button>
    <?php else: ?>
      <div class="login">
        <a href="/sessions/new">Sign up</a>
      </div>
    <?php endif; ?>
  </div>
</header>
