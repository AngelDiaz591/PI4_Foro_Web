<header>
  <i class='bx bx-menu menu' id="menu-icon" ></i>

  <img src="/resources/img/logo.png" alt="logo">
  <h2>CulturEdge</h2>

  <div class="seeker">
    <button action=""><i class='bx bx-search-alt'></i></button>
    <input class="cont" placeholder="Search" type="search">
  </div>
  
  <div class="actions">
    <?php if(isset($_SESSION['user'])): ?>
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
