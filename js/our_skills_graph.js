/* ========================================================================= */
/*	Our Skills Section Popularity Stack Graph
/* ========================================================================= */

document.addEventListener("DOMContentLoaded", function () {
    function generateSkillChart() {
        const currentYear = new Date().getFullYear();
        const years = Array.from({ length: 7 }, (_, i) => currentYear - 6 + i);

        const skillData = {
            labels: years,
            datasets: [
                {
                    label: 'Embedded Systems',
                    data: years.map((y, i) => 20 + i * 15),
                    borderColor: '#00c8ff',
                    backgroundColor: 'rgba(0, 200, 255, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'PCB Design',
                    data: years.map((y, i) => 15 + i * 15),
                    borderColor: '#ff8c00',
                    backgroundColor: 'rgba(255, 140, 0, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'DevOps & CI/CD',
                    data: years.map((y, i) => 10 + i * 15),
                    borderColor: '#4caf50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Software Development (Web, Desktop, Mobile)',
                    data: years.map((y, i) => 30 + i * 30),
                    borderColor: '#ff3d67',
                    backgroundColor: 'rgba(255, 61, 103, 0.2)',
                    borderWidth: 2,
                    fill: true
                }
            ]
        };

        const config = {
            type: 'line',
            data: skillData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { color: '#444' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#444' }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: { labels: { color: '#fff' } }
                }
            }
        };

        new Chart(document.getElementById('skillChart').getContext('2d'), config);
    }

    generateSkillChart();
});