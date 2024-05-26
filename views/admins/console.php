<?php
    // Obtener los datos pasados a la vista
    $topThemes = $data->topThemes;
    $temas = [];
    $cantidadPosts = [];

    foreach ($topThemes as $theme) {
        $temas[] = $theme->theme;  // Acceder a la propiedad 'theme' del objeto
        $cantidadPosts[] = $theme->post_count;  // Acceder a la propiedad 'post_count' del objeto
    }
    ?>


<div class="chart-container" style="max-width: 600px;">
    <canvas id="myChart"></canvas>
</div>

<script>
    // Datos para la gráfica desde PHP
    const temas = <?php echo json_encode($temas); ?>;
    const cantidadPosts = <?php echo json_encode($cantidadPosts); ?>;

    // Redondear valores en cantidadPosts para asegurar números enteros
    const cantidadPostsEnteros = cantidadPosts.map(value => Math.round(value));

    // Configuración de la gráfica
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: temas,
            datasets: [{
                label: 'Cantidad de Posts',
                data: cantidadPostsEnteros,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1  // Forzar valores enteros en el eje Y
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Top 5 Temas Más Populares'
                },
                legend: {
                    display: false
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

