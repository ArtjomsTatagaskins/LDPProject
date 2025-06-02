import { historyChart, substatusChart } from './charts-init.js';

export async function fetchStatistics(range = 'day') {
    showLoading(true);
    try {
        const params = new URLSearchParams({ range });
        const response = await fetch('/statistics-data?' + params.toString());
        if (!response.ok) throw new Error('Network error');
        const data = await response.json();

        updateStatsNumbers(data);
        updateCharts(data);
    } catch (error) {
        console.error('Fetch error:', error);
    } finally {
        showLoading(false);
    }
}

function updateStatsNumbers(data) {
    document.getElementById('deploymentTime').textContent = data.deploymentTime + ' min';
    document.getElementById('testCoverage').textContent = data.testCoverage + '%';
    document.getElementById('successRate').textContent = data.successRate + '%';
}

function updateCharts(data) {
    updateHistoryChart(data.history);
    updateSubstatusChart(data.substatus);
}

function updateHistoryChart(historyData) {
    const labels = historyData.map(item => item.display_date);
    const values = historyData.map(item => item.time);

    if (historyChart) {
        historyChart.data.labels = labels;
        historyChart.data.datasets[0].data = values;
        historyChart.update();
    }
}

function updateSubstatusChart(substatus) {
    const labels = Object.keys(substatus);
    const data = Object.values(substatus);

    if (substatusChart) {
        substatusChart.data.labels = labels;
        substatusChart.data.datasets[0].data = data;
        substatusChart.update();
    }
}

function showLoading(isLoading) {
    const table = document.getElementById('statistics-table');
    if (!table) return;
    table.style.opacity = isLoading ? 0.5 : 1;
}
