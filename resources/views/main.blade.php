@extends('layouts.app')

@section('title', 'Pipelines')

@section('content')
    <div class="pipeline-container">
        <h2>Pipelines</h2>
        <div class="sort-buttons">
            <button><img src="{{ asset('icons/date.svg') }}" alt="date">Datums</button>
            <button>Statuss</button>
        </div>

        <div class="pipeline-list">
            <div class="table-header">
                <div>Projekts</div>
                <div>Zars</div>
                <div>Statuss</div>
                <div>Pipeline Info</div>
            </div>

            @foreach ($pipelines as $pipeline)
                <div class="table-row">
                    <div>{{ $pipeline['project']['name'] ?? 'N/A' }}</div>
                    <div>{{ $pipeline['ref'] ?? 'N/A' }}</div>
                    <div>{{ ucfirst($pipeline['status']) }}</div>
                    <div><a href="{{ $pipeline['web_url'] }}">Link to pipeline</a></div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
