<?php
$action = isset($_GET['action']) ? $_GET['action'] : ''; 
$errors = isset($errors) ? $errors : array();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}
?>

<div class="emailVeri">
  <div class="leftImg">
  <div class="return2">
    <a href="/"><i class='bx bx-arrow-back comeback'></i></a>
  </div>
    <div class="principal2">
        <img src="/resources/img/respass2.svg" alt="login" class="imgNewPass">
    </div>
  </div>
  <div class="rightForm">
    <div class="return2 not">
      <a href="/"><i class='bx bx-arrow-back comeback'></i></a>
    </div>
    <div class="primaryForm">
      <div class="titleForgot">
        <span>Reset Your Password</span>
      </div>
      <p class="instruction">
        Enter your <span>new</span> password and <span>confirm</span> password
      </p>
      <div class="form-inputs">
        <form action="/passwords/update" method="POST">
          <input type="hidden" id="token" name="token" value="<?= $data['reset_password_token']; ?>">
          <div class="user-input">
            <input type="password" class="input" name="newpassword" placeholder=" " id="newpassword" required>
            <label class="form_label">New password</label>
            <i class="bi bi-lock icon"></i>
          </div>
          <div class="user-input">
            <input type="password" class="input" name="cpassword" placeholder=" " id="cpassword" required>
            <label class="form_label">Confirm password</label>
            <i class="bi bi-key icon"></i>
          </div>
          <div class="option">  
            <input type="submit" name="confirm" value="Reset Password" class="confirmEmail">
          </div>
          <div class="registeras2">
            <p>Didn't recieve the code?</p>
            <a href="/passwords/new" class="againpassword">Resend</a>
          </div>
        </form>
    </div>
  </div>
</div>
<script>
  setTimeout(function(){
    var errorAlert = document.getElementById("error-alert");
    if (errorAlert) {
      errorAlert.style.display = "none";
    }
  }, 3000);
</script>

