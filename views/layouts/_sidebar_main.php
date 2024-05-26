<ul class="main-nav">
  <ul>
    <li class="list">
      <div class="selector"></div>
      <a href="/" class="category">
        <i class='bx bxs-home'></i>
        <p>Home</p>
      </a>
    </li>
    <li class="list">
      <div class="selector"></div>
      <a class="category">
        <i class='bx bx-line-chart'></i>
        <p>Popular</p>
      </a>
    </li>
    <?php if (isset($_SESSION['user'])): ?>
      <li class="list">
        <div class="selector"></div>
        <a class="category" href="/posts/new">
          <i class='bx bx-news'></i>
          <p>New post</p>
        </a>
      </li>
    <?php endif; ?>
    <?php if (isset($_SESSION['user'])): ?>
      <li class="list">
        <div class="selector"></div>
        <a class="category" href="/posts/edit_table">
          <i class='bx bx-pencil'></i>
          <p>Edit post</p>
        </a>
      </li>
    <?php endif; ?>
  </ul>
  <ul class="line"></ul>
  <h3>CATEGORIES</h3>
  <ul id="unesco-themes">
    <li><p class="spinner spinner-green"></p></li>
  </ul>
  <ul class="line"></ul>
  <ul>
    <li href="#" class="list">
      <div class="selector"></div>
      <a class="category">
        <i class='bx bxs-help-circle' ></i>
        <p>Help</p>
      </a>
    </li>
    <li href="#" class="list">
      <div class="selector"></div>
      <a class="category">
        <i class='bx bxs-user' ></i>
        <p>About us</p>
      </a>
    </li>
    <li href="#" class="list">
      <div class="selector"></div>
      <a class="category">
        <i class='bx bx-question-mark' ></i>
        <p>Questions</p>
      </a>
    </li>
  </ul>
</ul>
