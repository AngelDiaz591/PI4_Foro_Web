<header>
  <i class='bx bx-menu menu' id="menu-icon" ></i>

  <img src="../../resources/img/logo.png" alt="">
  <h2>CulturEdge</h2>

  <div class="seeker">
    <button action=""><i class='bx bx-search-alt'></i></button>
    <input class="cont" placeholder="Search" type="search">
  </div>
  
  <div class="register">
    <div class="login">
      <?php if(isset($_SESSION['user'])): ?>
        <form action="<?= redirect_to('sessions', 'destroy'); ?>" method="post">
          <input type="submit" name="logout" value="Log out">
        </form>
      <?php else: ?>
        <a href="<?= redirect_to('sessions', 'new'); ?>">Log in</a>
      <?php endif; ?>
    </div>
  </div>
</header>
