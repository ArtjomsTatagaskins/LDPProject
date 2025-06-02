import Chart from 'chart.js/auto';

let historyChart = null;
let substatusChart = null;

document.addEventListener('DOMContentLoaded', function () {
    const historyCtx = document.getElementById('historyChart').getContext('2d');
    const gradient = historyCtx.createLinearGradient(0, 0, 0, historyCtx.canvas.height);
    gradient.addColorStop(0, 'rgba(30, 214, 145, 0.5)');
    gradient.addColorStop(1, 'rgba(30, 214, 145, 0)');

    historyChart = new Chart(historyCtx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Deployment Time',
                data: [],
                borderColor: '#1ed691',
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
                backgroundColor: ['#2d99fa', '#1ed691', '#fcc442']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});

export { historyChart, substatusChart };
