<!-- <a class="back" href="<?= get_last_url(); ?>">
  <i class="bi bi-arrow-left"></i>
</a> -->
<div class="user-view-container">
  <div class="left">
    <div class="principal2">
        <?= img_tag('login4.gif', 'login', 'img'); ?>
    </div>
    <p class="featured-words">
      The next step towards a better tomorrow! <span>Join</span> and <span>Move</span> forward.
    </p>
  </div>
  <div class="right">
    <div class="register2">
      <p>Create an account</p>
      <a href="<?= redirect_to('registrations', 'new'); ?>" class="new">Joined</a>
    </div>
    <div class="principal">
      <div class="slogan">
        <span>WELCOME BACK!</span>
      </div>
      <div class="form-inputs">
        <form action="<?= redirect_to('sessions', 'create'); ?>" method="POST" autocomplete="">
          <?php
          if (isset($_SESSION['error'])):
              $error_message = $_SESSION['error'];
              unset($_SESSION['error']); ?>
            <div id="error-alert" class="alert2">
              <i class="bi bi-info-circle icon-alert2"></i>
              <p>Error: <?php echo $error_message; ?></p>
            </div>
          <?php endif; ?>
          <div class="user-input">
            <input class="input" type="email" name="email" id="user-input" placeholder=" ">
            <label class="form_label">Email</label>
            <i class="bi bi-person icon" id="user-input"></i>
            
          </div> 
          <div class="user-input">
            <input class="input" type="password" name="password" id="user-input" placeholder=" ">
            <label class="form_label">Password</label>
            <i class="bi bi-lock icon" id="user-input"></i>
          </div>
          <div class="box-small">
            <a href="<?= redirect_to('passwords', 'new'); ?>" class="forgot">Forgot your password?</a>
          </div>
          <div class="user-input">
            <button class="btn-sign" name="login">
              <span>SIGN IN</span>
            </button>
          </div>
          
        </form>
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
