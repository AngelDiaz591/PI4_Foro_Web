<?php
session_start();

// Verificar si la solicitud proviene de la página de verificación y no hay errores
if ($_SERVER['HTTP_REFERER'] === 'http://localhost/foroweb/views/Verify/code.php' && !isset($_SESSION['error']) && !isset($_SESSION['page_status'])) {
    unset($_SESSION['email']);
}
?>
