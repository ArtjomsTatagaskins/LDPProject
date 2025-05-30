import Chart from 'chart.js/auto';

let historyChart = null;
let substatusChart = null;

async function fetchStatistics() {
    try {
        const response = await fetch('/statistics-data');
        if (!response.ok) throw new Error('Network error');
        const data = await response.json();

        updateCharts(data);
    } catch (error) {
        console.error('Fetch error:', error);
    }
}

function updateCharts(data) {
    const historyLabels = data.history.map(item => item.display_date);
    const historyData = data.history.map(item => item.time);
    const substatusLabels = Object.keys(data.substatus);
    const substatusData = Object.values(data.substatus);

    if (historyChart) {
        historyChart.data.labels = historyLabels;
        historyChart.data.datasets[0].data = historyData;
        historyChart.update();
    }

    if (substatusChart) {
        substatusChart.data.labels = substatusLabels;
        substatusChart.data.datasets[0].data = substatusData;
        substatusChart.update();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const historyCtx = document.getElementById('historyChart').getContext('2d');
    const gradient = historyCtx.createLinearGradient(0, 0, 0, historyCtx.canvas.height);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.5)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

    historyChart = new Chart(historyCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Deployment Time',
                data: [],
                borderColor: '#6366f1',
                backgroundColor: gradient,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const substatusCtx = document.getElementById('substatusChart').getContext('2d');
    substatusChart = new Chart(substatusCtx, {
        type: 'doughnut',
        data: {
            labels: [],
            datasets: [{
                data: [],
                backgroundColor: ['#a78bfa', '#f472b6', '#60a5fa']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    fetchStatistics();
    setInterval(fetchStatistics, 30000);
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
