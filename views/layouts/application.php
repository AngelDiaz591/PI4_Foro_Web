<?php 
include './../../controllers/application_controller.php';

session_start();

if (empty($_GET['controller']) || empty($_GET['action'])) {
  redirect_to_error('404');
}

$controller = $_GET['controller'];
$action = $_GET['action'];

$data = array(
  "method" => $_POST ? $_POST : $_GET,
  "files" => $_FILES,
);

if ($action === 'create' || $action === 'update' || $action === 'delete' || 
      $action === 'purge_image' || $action === 'patch' || $action === 'destroy' ||
      $action === 'create_comment_father') {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'GET') {
    redirect_to_error('405');
  }

  render($action, $controller, $data);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CulturEdge</title>
  <!-- Favicon -->
  <?= link_tag('icon', 'img/favicon.ico', 'image/x-icon'); ?>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Almarai&family=Inter&family=Lato&family=Roboto+Slab&family=Rubik&family=Poppins&display=swap">
  <!-- ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
  <!-- STYLESHEETS -->
  <?= link_tag('stylesheet', 'stylesheets/main.css'); ?>
  <!-- SCRIPT -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <?= script_tag('main'); ?>
</head>
<body>
  <?php if ($controller === 'sessions' && $action === 'new' || 
              $controller === 'registrations' && $action === 'new' ||
              $controller === 'passwords' && $action === 'new' ||
              $controller === 'passwords' && $action === 'edit' ||
              $controller === 'confirmations' && $action === 'new'): ?>
    <div class="user-view-wrapper">
      <?= render($action, $controller, $data); ?>
    </div>
  <?php else: ?>
    <?= render_layout('header'); ?>
    
    <div class="container">
      <nav id="main-nav">
        <?= render_layout('sidebar_main'); ?>
      </nav>

      <main>
        <?= render($action, $controller, $data); ?>
      </main>
      
      <div id="modal" class="modal-container">
        <div class="modal-header">
          <i class='bx bx-error'></i>
          <h2>log in to interact</h2>
        </div>
        <span class="close-modal" onclick="closeModal()">&times;</span>
      </div>

      <?php if($controller !== 'sessions' && $action !== 'show'): ?>
        <?= render_layout('sidebar_chats'); ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</body>
</html>
