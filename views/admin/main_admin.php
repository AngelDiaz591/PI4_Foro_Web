<?php 
include './../../controllers/application_controller.php';

session_start();

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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <?= script_tag('main'); ?>
</head>
<body>
    <?= render_layout('admin_header'); ?>
    
    <div class="container">
      <nav id="main-nav">
        <?= render_layout('sidebar_admin'); ?> 
      </nav>

      <style>
        .general-data {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          margin: 40px 50px;
        }

        .boxed-data {
          background-color: #333333;
          color: white;
          display: flex;
          align-items: center;
          padding: 10px;
          margin-bottom: 10px;
          border-radius: 5px;
          width: 30%;
        }

        .boxed-data i {
          font-size: 24px;
          margin-right: 10px;
        }

        .boxed-data p {
          margin: 0;
        }
        </style>

      <main class="dashboard_admin_content">
      <div class="chart-container" style="background-color: rgba(245, 236, 183, 0.96); padding: 20px; margin: 10px 50px 10px 50px;">
      <canvas id="myChart"></canvas>
      </div>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['End of Poverty', 'Zero Hunger', 'Health and Wellness', 'Quality Education'],
                    datasets: [{
                        label: 'Total Number of Publications',
                        data: [80, 65, 75, 85], // Valores de ejemplo
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
         options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Most Popular Topics'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
            });
        </script>

        <div class="general-data">
          <div class="boxed-data">
            <i class='bx bxs-collection'></i>
            <p>Topics: 15</p>
          </div>
          <div class="boxed-data">
            <i class='bx bxs-notepad'></i>
            <p>Total Publications: 305</p>
          </div>
          <div class="boxed-data">
            <i class='bx bxs-chat'></i>
            <p>Comments: 2000</p>
          </div>
          <div class="boxed-data">
            <i class='bx bxs-like'></i>
            <p>Likes: 1355</p>
        </div>
          <div class="boxed-data">
            <i class='bx bxs-user-circle'></i>
            <p>Active Users: 19</p>
          </div>
          <div class="boxed-data">
            <i class='bx bxs-group'></i>
            <p>Total Users: 135</p>
          </div>
        </div>    

      </main>
      
      <div id="modal" class="modal-container">
        <div class="modal-header">
          <i class='bx bx-error'></i>
          <h2>log in to interact</h2>
        </div>
        <span class="close-modal" onclick="closeModal()">&times;</span>
      </div>

      <?= render_layout('sidebar_admin_posts_approval'); ?>
    </div>
</body>
</html>