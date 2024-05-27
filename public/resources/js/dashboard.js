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
                responsive: true, // Hacer la gráfica responsiva
                /* maintainAspectRatio: false, // Permitir que la gráfica se ajuste a cualquier proporción */
                plugins: {
                    title: {
                        display: true,
                        text: 'Temas Más Populares', // Título de la gráfica
                        font: {
                            size: 24, // Tamaño de la fuente
                            family: 'Arial, sans-serif', // Familia de la fuente
                            weight: 'bold', // Peso de la fuente
                            color: '#333' // Color de la fuente
                        },
                        padding: {
                            top: 10,
                            bottom: 30
                        },
                        align: 'start'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Agregar un evento de redimensionamiento para forzar la actualización de la gráfica
        window.addEventListener('resize', function() {
            myChart.resize();
        });
