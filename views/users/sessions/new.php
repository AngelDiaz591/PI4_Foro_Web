<a class="back" href="<?= get_last_url(); ?>">
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
      <form action="<?= redirect_to('sessions', 'create'); ?>" method="POST" autocomplete="">
        <div class="slogan">
          <h2>WELCOME BACK!</h2>
        </div>
        <?php
        if (isset($_SESSION['error'])):
            $error_message = $_SESSION['error'];
            unset($_SESSION['error']); ?>
          <div id="error-alert" class="alert2">
            <i class="bi bi-info-circle icon-alert"></i>
            <p>Error: <?php echo $error_message; ?></p>
          </div>
        <?php endif; ?>
        <div class="user-input">
          <input class="input" type="email" name="email" id="user-input" placeholder="Email">
          <i class="bi bi-person icon" id="user-input"></i>
        </div> 
        <div class="user-input">
          <input class="input" type="password" name="password" id="user-input" placeholder="Password">
          <i class="bi bi-lock icon" id="user-input"></i>
        </div>
        <!--<div class="box-small">
          <a href="<?//= redirect_to('passwords', 'new'); ?>" class="forgot">Forgot your password?</a>
        </div>-->
        <div class="option">
          <button class="btn-sign" name="login">SIGN IN</button>
        </div>
      </form>
      <div class="register">
        <p>Do not you have an account yet?</p>
        <a href="<?= redirect_to('registrations', 'new'); ?>" class="new">Sign Up</a>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_SESSION['success'])) {
    echo '<div class="success-message">' . $_SESSION['success'] . '</div>';
    // Eliminar el mensaje de éxito de la sesión para que no se muestre nuevamente
    unset($_SESSION['success']);
}
?>
<div id="errorMessages"></div>
<script src="validacion.js"></script>
<script>
    setTimeout(function(){
        document.getElementById("error-alert").style.display = "none";
    }, 3000); // 3000 milliseconds = 3 seconds
</script>
