<?php
$action = isset($_GET['action']) ? $_GET['action'] : ''; 
$errors = isset($errors) ? $errors : array();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}
?>

<center>
  <h2>Enter your new password and confirm password</h2>
  <form action="/passwords/update" method="POST">
    <input type="hidden" id="token" name="token" value="<?= $data['reset_password_token']; ?>">
    <div class="user-input">
      <input type="password" class="input" name="newpassword" placeholder="newPassword" id="newpassword" required>
    </div>
    <div class="user-input">
      <input type="password" class="input" name="cpassword" placeholder="Confirm password" id="cpassword" required>
    </div>
    <div class="confirm">
      <a href="/passwords/new" class="new">Send code again</a>
      <input type="submit" name="confirm" value="confirm" class="new">
    </div>
  </form>
</center>
<script>
  setTimeout(function(){
    var errorAlert = document.getElementById("error-alert");
    if (errorAlert) {
      errorAlert.style.display = "none";
    }
  }, 3000);
</script>

