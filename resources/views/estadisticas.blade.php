<x-app-layout>
    <div class="container">
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        
        // Obtener los datos de los candidatos y votos desde PHP
        const candidatos = @json($candidatos);

        // Extraer los nombres de los candidatos y sus votos
        const nombresCandidatos = candidatos.map(candidato => candidato.nombre);
        const votosCandidatos = candidatos.map(candidato => candidato.votos);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombresCandidatos, // Usar los nombres de los candidatos como etiquetas
                datasets: [{
                    label: '# de Votos',
                    data: votosCandidatos, // Usar los votos de los candidatos como datos
                    backgroundColor: [ // Colores personalizados para las barras
                        'rgba(255, 99, 132, 0.5)', // Red
                        'rgba(54, 162, 235, 0.5)', // Blue
                        'rgba(255, 206, 86, 0.5)', // Yellow
                        'rgba(75, 192, 192, 0.5)', // Green
                        'rgba(153, 102, 255, 0.5)', // Purple
                        'rgba(255, 159, 64, 0.5)' // Orange
                    ],
                    borderColor: [ // Colores de borde para las barras
                        'rgba(255, 99, 132, 1)', // Red
                        'rgba(54, 162, 235, 1)', // Blue
                        'rgba(255, 206, 86, 1)', // Yellow
                        'rgba(75, 192, 192, 1)', // Green
                        'rgba(153, 102, 255, 1)', // Purple
                        'rgba(255, 159, 64, 1)' // Orange
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
