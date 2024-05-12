<?php
$errors = isset($errors) ? $errors : array();
$errors = isset($_SESSION['code_verification_errors']) ? $_SESSION['code_verification_errors'] : array();
?>
<section class="code_verify">
  <img src="/resources/img/email2.svg" class="codever">
  <div class="title">
    <p>Check in your Email!</p>
  </div>
  <?php if (isset($_SESSION['error'])):
    $error_message = $_SESSION['error'];
    unset($_SESSION['error']); ?>
    <div id="error-alert" class="alert2">
        <i class="bi bi-info-circle icon-alert"></i>
        <p>Error: <?php echo $error_message; ?></p>
    </div>
  <?php endif; ?>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 421e406 (structuring and interface design)
  <form action="/confirmations/create" method="POST" autocomplete="off">
    <input type="hidden" id="code" name="code">
    <input type="hidden" id="token" name="token" value="<?= $data['confirm_token']; ?>">
    <div id="inputs" class="group-inputs">
      <input class="inputs" id="input1" type="text" placeholder="0" maxLength="1" required>
      <input class="inputs" id="input2" type="text" placeholder="0" maxLength="1" required>
      <input class="inputs" id="input3" type="text" placeholder="0" maxLength="1" required>
      <input class="inputs" id="input4" type="text" placeholder="0" maxLength="1" required>
      <input class="inputs" id="input5" type="text" placeholder="0" maxLength="1" required>
      <input class="inputs" id="input6" type="text" placeholder="0" maxLength="1" required>
    </div>
      <input type="submit" class="verify" name="check" value="Verify Code">
  </form>
<<<<<<< HEAD
=======
  <!-- <div class="group-inputs"> -->
    <form action="/confirmations/create" method="POST" autocomplete="off">
      <input type="hidden" id="code" name="code">
      <input type="hidden" id="token" name="token" value="<?= $data['confirm_token']; ?>">
      <div id="inputs" class="group-inputs">
        <input class="inputs" id="input1" type="text" placeholder="0" maxLength="1" required>
        <input class="inputs" id="input2" type="text" placeholder="0" maxLength="1" required>
        <input class="inputs" id="input3" type="text" placeholder="0" maxLength="1" required>
        <input class="inputs" id="input4" type="text" placeholder="0" maxLength="1" required>
        <input class="inputs" id="input5" type="text" placeholder="0" maxLength="1" required>
        <input class="inputs" id="input6" type="text" placeholder="0" maxLength="1" required>
      </div>
      <!-- <div class="confirm"> -->
        <input type="submit" class="verify" name="check" value="Verify Code">
      <!-- </div> -->
    </form>
  <!-- </div> -->
  
>>>>>>> 3a25165 (user form design)
=======
>>>>>>> 421e406 (structuring and interface design)
  <div class="resend_code">
    <p>Haven't received it?</p>
    <form action="/confirmations/update" method="POST" autocomplete="off">
      <input type="hidden" id="token" name="token" value="<?= $data['confirm_token']; ?>">
      <input type="submit" class="resend" name="resend" value="Resend code">
    </form>
  </div>
  <p class="warning">The code will only be valid for 10 minutes</p>
</section>
<script src="/resources/js/veri_code.js"></script>
<?php if (isset($_SESSION['error_message'])): ?>
  <script>
    var errorMessage = "<?php echo $_SESSION['error_message']; ?>";
    if (errorMessage) {
      var confirmed = confirm(errorMessage);
      if (confirmed) {
        <?php
        unset($_SESSION['error_message']);
        ?>
      }
    }
  </script>
<?php endif; ?>
