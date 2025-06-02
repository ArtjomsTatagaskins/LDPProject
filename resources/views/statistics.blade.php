@extends('layouts.app')

@section('title', 'Pipelines')

@section('content')
    <div class="stats-wrapper">
        <h2>Statistics Overview</h2>

        <div class="stats-cards">
            <div class="stats-card">
                <h2>Deployment Time</h2>
                <p id="deploymentTime">{{ $data['deploymentTime'] }} min</p>
            </div>
            <div class="stats-card">
                <h2>Test Coverage</h2>
                <p id="testCoverage">{{ $data['testCoverage'] }}%</p>
            </div>
            <div class="stats-card">
                <h2>Success Rate</h2>
                <p id="successRate">{{ $data['successRate'] }}%</p>
            </div>
        </div>

        <div class="stats-graphs">
            <div class="chart-container">
                <h3>Deployment History</h3>
                <div class="filter-container">
                    <select id="rangeSelector">
                        <option value="day">1 day</option>
                        <option value="week">7 days</option>
                        <option value="month">30 days</option>
                    </select>
                </div>
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
@endsection
