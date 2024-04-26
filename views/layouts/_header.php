<header>
  <i class='bx bx-menu menu' id="menu-icon" ></i>

  <img src="/resources/img/logo.png" alt="logo">
  <h2>CulturEdge</h2>

  <div class="seeker">
    <button action=""><i class='bx bx-search-alt'></i></button>
    <input class="cont" placeholder="Search" type="search">
  </div>
  
  <div class="register">
    <?php if(isset($_SESSION['user'])): ?>
      <i class='notifications bx bx-bell'></i>
      <button id="btn-user" class="user-menu">
        <img src="/resources/img/user.png" alt="user">
      </button>
    <?php else: ?>
      <div class="login">
        <a href="/sessions/new">Sign up</a>
      </div>
    <?php endif; ?>

  </div>
</header>
<?php if(isset($_SESSION['user'])): ?>
  <div id="menu-user" class="menu-user">
    <ul class="list-user">
      <div class="profile-menu">
        <img src="/resources/img/user.png" alt="user" class="user-img">
        <div class="user-information">
          <?php
         echo $_SESSION['user']['username']. "<br>";
         echo $_SESSION['user']['email'];?>         
        </div>
      </div>
      <div class="line"></div>
      <a href="#"><li>view Profile</li></a>
      <a href="#"><li>Settings</li></a>
      <a href="#"><li>Languaje</li> </a>
      <a href="#"><li>Help</li></a>
      <li>
        <form action="/sessions/destroy" method="post">
          <input type="submit" name="logout" value="Log out">
        </form>
      </li>
    </ul>
  </div>
<?php endif; ?>
