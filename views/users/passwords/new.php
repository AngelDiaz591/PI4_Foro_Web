<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';
$errors = isset($errors) ? $errors : array();
?>
<div class="emailVeri">
  <div class="leftImg">
    <div class="return2">
      <a href="/"><i class='bx bx-arrow-back comeback'></i></a>
    </div>
    <div class="principal2">
      <img src="/resources/img/respass.svg" alt="login" class="imgPass">
    </div>
  </div>
  <div class="rightForm">
    <div class="return2 not">
      <a href="/"><i class='bx bx-arrow-back comeback'></i></a>
    </div>
    <div class="primaryForm">
      <div class="titleForgot">
        <span>Forgot Your Password?</span>
      </div>
      <p class="instruction">
        Enter your email for send code for <span>change password</span>
      </p>
      <div class="form-inputs">
        <?php if (isset($_SESSION['error'])):
          $error_message = $_SESSION['error']; ?>
          <div id="error-alert" class="alert2">
            <i class="bi bi-info-circle icon-alert"></i>
            <p>Error: <?= $error_message; ?></p>
          </div>
        <?php endif; ?>
        <form action="/passwords/create" method="POST">
          <div class="user-input">
            <input type="email" name="email" id="email" placeholder=" " class="input" required>
            <label class="form_label">Email</label>
            <i class="bi bi-envelope icon"></i>
          </div>
          <div class="option">  
            <input type="submit" name="send" value="Continue" class="confirmEmail">
          </div>
          <div class="registeras">
            <p>Already have account?</p>
            <a href="/sessions/new" class="newas">Sign In</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  setTimeout(function() {
    var errorAlert = document.getElementById("error-alert");
    if (errorAlert) {
      errorAlert.style.display = "none";
    }
  }, 3000);
</script>
