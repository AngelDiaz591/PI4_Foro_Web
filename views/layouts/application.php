<?php 
include './../../controllers/application_controller.php';

if (empty($_GET['controller']) || empty($_GET['action'])) {
  redirect_to_error('404');
}

$controller = $_GET['controller'];
$action = $_GET['action'];

$data = $_POST ? $_POST : $_GET;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visitante</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <?= link_tag('stylesheet', 'main'); ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <?= script_tag('main'); ?>
</head>
<body>
  <?php render_layout('header'); ?>
  
  <div class="container">
    <?php render_layout('sidebar_main'); ?>

    <main>
      <?= render($action, $controller, $data); ?>
    </main>

    <?php render_layout('sidebar_chats'); ?>
  </div>
</body>
</html>
