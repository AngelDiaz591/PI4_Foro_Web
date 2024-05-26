// Datos para la gráfica
const temas = ['Tema 1', 'Tema 2', 'Tema 3', 'Tema 4', 'Tema 5'];
const cantidadPosts = [150, 120, 100, 80, 60];

// Configuración de la gráfica
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: temas,
        datasets: [{
            label: 'Cantidad de Posts',
            data: cantidadPosts,
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
                beginAtZero: true
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
