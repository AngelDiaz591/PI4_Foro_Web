<script>
  function showWarningMessage() {
    alert("Your account will be deleted if not verified within 10 minutes. Proceed with caution.");
  }
</script>
<a href="<?= get_last_url(); ?>" class="back">
  <i class="bi bi-arrow-left"></i>
</a>
<div class="user-view-container">
  <div class="left">
      <div class="principal2">
        <?= img_tag('login.jpg', 'login', 'img'); ?>
      </div>
  </div>
  <div class="right">
    <div class="principal">
      <form action="<?= redirect_to('registrations', 'create'); ?>" method="POST" autocomplete="">
        <div class="slogan">
          <h1>Create an account</h1>
          <p>Start your account with us</p>
        </div>
        <?php if (isset($_SESSION['error'])):
            $error_message = $_SESSION['error'];
            unset($_SESSION['error']); ?>
          <div id="error-alert" class="alert2">
            <i class="bi bi-info-circle icon-alert"></i>
            <p>Error: <?php echo $error_message; ?></p>
          </div>
        <?php endif; ?>
        <div class="user-input">
          <input class="input" type="text" name="username" placeholder="Username" required>
          <i class="bi bi-person icon"></i>
        </div>
        <div class="user-input">
          <input class="input" type="email" name="email" placeholder="Email" id="email" required>
          <i class="bi bi-envelope icon"></i>
          <p id="emailmsg"><span id="emailstrenght"></span></p>
        </div>
        <div class="user-input">
          <input type="password" class="input" name="password" placeholder="Password" id="password" required>
          <i class="bi bi-lock icon"></i>
          <p id="message">Password is <span id="strenght"></span></p>
        </div>
        <div class="user-input">
          <input type="password" class="input" name="cpassword" placeholder="Confirm password" id="cpassword" required>
          <i class="bi bi-lock icon"></i>
          <p id="nomessage">Password <span id="constrength"></span></p>
        </div>
        <div class="option2">
          <div class="btn-create">
            <input class="signup" type="submit" name="signup" value="Create an account" onclick="showWarningMessage()">
          </div>
        </div>
      </form>
      <div class="register">
        <p>Already have an account?</p>
        <a href="<?= redirect_to('sessions', 'new'); ?>" class="new">Sign In</a>
      </div>
    </div>
  </div>
</div>
<?= script_tag('form'); ?>
<script>
  setTimeout(function(){
    var errorAlert = document.getElementById("error-alert");
    if (errorAlert) {
      errorAlert.style.display = "none";
    }
  }, 3000);
</script>
