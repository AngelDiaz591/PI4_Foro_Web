<?php 
include './../controllers/application_controller.php';

session_start();

get_model('router');

$router = new Router();
$controller = $router->controller;
$action = $router->action;

$special_controllers = ['sessions', 'confirmations', 'registrations', 'passwords'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CulturEdge</title>
  <!-- Favicon -->
  <?//= link_tag('icon', 'img/favicon.ico', 'image/x-icon'); ?>
  <link rel="icon" href="/resources/img/favicon.ico" type="image/x-icon">
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Almarai&family=Inter&family=Lato&family=Roboto+Slab&family=Rubik&family=Poppins&display=swap">
  <!-- ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
  <!-- STYLESHEETS -->
  <?//= link_tag('stylesheet', 'stylesheets/main.css'); ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/resources/js/main.js"></script>
  <link rel="stylesheet" href="/resources/stylesheets/main.css">
</head>
<?php if (in_array($controller, $special_controllers)): ?>
  <body>
    <div class="user-view-wrapper">
      <?= $router->dispatch() ?>
    </div>
  </body>
<?php else: ?>
  <body>
    <?= render_layout('header'); ?>
    
    <div class="container">
      <nav id="main-nav">
        <?= render_layout('sidebar_main'); ?>
      </nav>

      <main>
        <?= $router->dispatch() ?>
      </main>
      
      <div id="modal" class="modal-container">
        <div class="modal-header">
          <i class='bx bx-error'></i>
          <h2>log in to interact</h2>
        </div>
        <span class="close-modal" onclick="closeModal()">&times;</span>
      </div>

      <?= render_layout('sidebar_chats'); ?>
    </div>
  </body>
<?php endif; ?>
</html>
