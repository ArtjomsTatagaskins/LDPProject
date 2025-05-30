@extends('layouts.app')

@section('title', 'Pipelines')

@section('content')
    <div class="stats-wrapper">
        <h1>Statistics Overview</h1>

        <div class="stats-cards">
            <div class="stats-card">
                <h2>Deployment Time</h2>
                <p>{{ $data['deploymentTime'] }} h</p>
            </div>
            <div class="stats-card">
                <h2>Test Coverage</h2>
                <p>{{ $data['testCoverage'] }}%</p>
            </div>
            <div class="stats-card">
                <h2>Success Rate</h2>
                <p>{{ $data['successRate'] }}%</p>
            </div>
        </div>

        <div class="stats-graphs">
            <div class="chart-container">
                <h3>Deployment History</h3>
                <div class="canvas-wrapper">
                    <canvas id="historyChart"></canvas>
                </div>
            </div>
            <div class="chart-container">
                <h3>Substatus</h3>
                <div class="canvas-wrapper">
                    <canvas id="substatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.statisticsData = {
            historyLabels: {!! json_encode(array_column($data['history'], 'date')) !!},
            historyData: {!! json_encode(array_column($data['history'], 'time')) !!},
            substatusLabels: {!! json_encode(array_keys($data['substatus'])) !!},
            substatusData: {!! json_encode(array_values($data['substatus'])) !!}
        };
    </script>
@endsection
