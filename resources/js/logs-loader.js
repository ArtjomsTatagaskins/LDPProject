export async function fetchLogs() {
    try {
        const response = await fetch('/logs/data');
        if (!response.ok) throw new Error('Network error');
        const logs = await response.json();

        updateLogsTable(logs);
    } catch (error) {
        console.error('Fetch logs error:', error);
    }
}

function updateLogsTable(logs) {
    const tbody = document.getElementById('logs-body');
    if (!tbody) return;

    tbody.innerHTML = '';

    logs.forEach(log => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${log.time}</td>
            <td><span class="level level-${log.level.toLowerCase()}">${log.level}</span></td>
            <td>${log.service}</td>
            <td>${log.message}</td>
            <td>${log.author}</td>
            <td>${log.duration}</td>
        `;
        tbody.appendChild(tr);
    });
}
