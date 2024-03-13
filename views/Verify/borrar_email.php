<?php
session_start();
// Check if the request is coming from the verification page and there are no errors
if ($_SERVER['HTTP_REFERER'] === 'http://localhost/foroweb/views/Verify/code.php' && !isset($_SESSION['error']) && !isset($_SESSION['page_status'])) {
    // If conditions are met, unset the email session variable
    unset($_SESSION['email']);
}
?>
