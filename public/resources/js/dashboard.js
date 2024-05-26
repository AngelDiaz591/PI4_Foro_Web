
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
