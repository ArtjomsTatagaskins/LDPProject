import './menu-toggle.js';
import { fetchStatistics } from './statistics-data.js';
import { fetchLogs } from './logs-loader.js';

document.addEventListener('DOMContentLoaded', () => {
    const rangeSelector = document.getElementById('rangeSelector');
    let debounceTimer = null;

    if (rangeSelector) {
        rangeSelector.addEventListener('change', e => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                fetchStatistics(e.target.value);
            }, 300); 
        });
    }

    fetchStatistics('day');
    fetchLogs();

    setInterval(() => fetchStatistics(rangeSelector?.value || 'day'), 30000);
    setInterval(fetchLogs, 30000);
});
