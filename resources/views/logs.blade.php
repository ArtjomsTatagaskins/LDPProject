@extends('layouts.app')

@section('title', 'Logs')

@section('content')
    <div class="logs-section">
        <h2>Logs</h2>
        <table>
            <thead>
            <tr>
                <th>Time</th>
                <th>Level</th>
                <th>Service (Branch)</th>
                <th>Message</th>
                <th>Author</th>
                <th>Duration</th>
            </tr>
            </thead>
            <tbody id="logs-body">
            </tbody>
        </table>
    </div>

    <script>
        async function fetchLogs() {
            try {
                const response = await fetch('{{ route('logs.data') }}');
                if (!response.ok) throw new Error('Network error');
                const logs = await response.json();

                const tbody = document.getElementById('logs-body');
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
            } catch (error) {
                console.error('Ошибка загрузки логов:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchLogs();
            setInterval(fetchLogs, 30000);
        });
    </script>
@endsection
