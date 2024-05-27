<div class="body_wrapper">
    <div class="welcome-admin">
      <h1>WELCOME BACK, <?= $data->username ?>!</h1>
      <p>Good to see you again!</p>
      <h6>Overview</h6>
    </div>
    <div class="general-data">
      <div class="boxed-data">
        <img src="/resources/img/icon-user.svg" alt="">
        <div>
          <p class="count5">135</p>
          <p class="statistics">Total Users</p>
        </div>
      </div>
      <div class="boxed-data">
          <img src="/resources/img/icon-reaction.svg" alt="">
        <div>
          <p class="count4">1355</p>
          <p class="statistics">Total Reactions</p>
        </div>
    </div>
    <div class="boxed-data">
        <img src="/resources/img/icon-post.svg" alt="">
        <div>
          <p class="count2">305</p>
          <p class="statistics">Total Posts</p>
        </div>
      </div>
    </div>
    <div class="chart-container">
      <div class="graphics">
        <canvas id="myChart">
        </canvas>
      </div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/resources/js/dashboard.js"></script>
