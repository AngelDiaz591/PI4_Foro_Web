<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';
$errors = isset($errors) ? $errors : array();
?>

<h2>Enter your email for send code for change password </h2>
<?php if (isset($_SESSION['error'])):
  $error_message = $_SESSION['error']; ?>
  <div id="error-alert" class="alert2">
    <i class="bi bi-info-circle icon-alert"></i>
    <p>Error: <?= $error_message; ?></p>
  </div>
<?php endif; ?>
<form action="/passwords/create" method="POST">
  <input type="email" name="email" id="email" placeholder="Email" required>
  <div class="option">
    <a href="/sessions/new" class="new">Sign In</a>
    <input type="submit" name="send" value="Send" class="new">
  </div>
</form>
<script>
  setTimeout(function() {
    var errorAlert = document.getElementById("error-alert");
    if (errorAlert) {
      errorAlert.style.display = "none";
    }
  }, 3000);
</script>
