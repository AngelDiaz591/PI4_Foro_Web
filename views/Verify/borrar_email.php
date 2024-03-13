<?php
session_start();

// Check if the request is coming from the verification page
if ($_SERVER['HTTP_REFERER'] === 'http://localhost/foroweb/views/Verify/code.php') {
    // Check if there are no errors
    if (!isset($_SESSION['error']) && !isset($_SESSION['page_status'])) {
        // Remove the 'email' parameter
        unset($_SESSION['email']);
    }
}
?>