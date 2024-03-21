<ul class="icons">
  <a href="main_admin.php" class="list">
    <li class="category">
      <i class='bx bxs-dashboard'></i>
      <p>Dashboard</p>
    </li>
  </a>
  <a href="#" class="list">
    <li class="category">
      <i class='bx bxs-notepad' ></i>
      <p>Publications</p>
    </li>
  </a>
  <a href="#" class="list">
    <li class="category">
      <i class='bx bxs-collection'></i>
      <p>Topics</p>
    </li>
  </a>
  <a href="#" class="list">
    <li class="category">
      <i class='bx bxs-group' ></i>
      <p>Users</p>
    </li>
  </a>
  <a href="#" class="list">
    <li class="category">
      <i class='bx bx-support' ></i>
      <p>Support</p>
    </li>
  </a>
  <a href="#" class="list">
    <li class="category">
      <i class='bx bx-shield-quarter'></i>
      <p>Permissions</p>
    </li>
  </a>
  <a href="#" class="list">
    <li class="category">
      <i class='bx bxs-help-circle' ></i>
      <p>History</p>
    </li>
  </a>
  <a href="#" class="list">
    <li class="category">
    <i class='bx bxs-cog' ></i>
      <p>Settings</p>
    </li>
  </a>
  <br> 
  <li class="line"></li>
  <a href="#" class="list">
    <li class="category">
      <i class='bx bx-log-out' ></i>
      <form action="<?= redirect_to('sessions', 'destroy'); ?>" method="post">
          <input type="submit" name="logout" value="Log out">
      </form>
    </li>
  </a>
</ul>
  
