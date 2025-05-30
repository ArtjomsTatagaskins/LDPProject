import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    if (!window.statisticsData) return;

    const { historyLabels, historyData, substatusLabels, substatusData } = window.statisticsData;

    const historyCtx = document.getElementById('historyChart')?.getContext('2d');
    const substatusCtx = document.getElementById('substatusChart')?.getContext('2d');

    if (historyCtx) {
        new Chart(historyCtx, {
            type: 'line',
            data: {
                labels: historyLabels,
                datasets: [{
                    label: 'Deployment Time',
                    data: historyData,
                    borderColor: '#6366f1',
                    tension: 0.3,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    if (substatusCtx) {
        new Chart(substatusCtx, {
            type: 'doughnut',
            data: {
                labels: substatusLabels,
                datasets: [{
                    data: substatusData,
                    backgroundColor: ['#a78bfa', '#f472b6', '#60a5fa']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }
});
function toggleMenu() {
    const menu = document.getElementById('menu');
    const menuToggle = document.querySelector('.menu-toggle');

    menu.classList.toggle('open');

    const openImg = menuToggle.querySelector('.open');
    const closeImg = menuToggle.querySelector('.close');

    if (menu.classList.contains('open')) {
        openImg.style.display = 'none';
        closeImg.style.display = 'inline-block';
    } else {
        openImg.style.display = 'inline-block';
        closeImg.style.display = 'none';
    }
}
