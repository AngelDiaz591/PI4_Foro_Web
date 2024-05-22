<header>
  <?php if (!str_contains(filter_input_array(INPUT_GET)['uri'], 'users')): ?>
    <i class='bx bx-menu menu' id="menu-icon" ></i>
  <?php endif; ?>

  <a href="/" class="logo">
    <img src="/resources/img/logo.png" alt="logo">
    <h2>CulturEdge</h2>
  </a>

  <div class="seeker">
    <input class="cont" placeholder="Search" type="search" id="search-input">
    <button id="search-button"><i class='bx bx-search-alt'></i></button>
</div>
  <div class="actions">
    <?php if(isset($_SESSION['user'])): ?>
      <?php if($_SESSION['user']['rol'] === 0): ?>
        <a href="/admins/console" class="btn-console">
          <i class='bx bx-grid-alt'></i>
        </a>
      <?php endif; ?>
      <button class="btn-notifications" onclick="app.userNotificationsOpen()">
        <i class='notifications-icon bx bx-bell'></i>
        <span class="notifications-count">
          <span class="spinner spinner-red"></span>
        </span>
      </button>
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
