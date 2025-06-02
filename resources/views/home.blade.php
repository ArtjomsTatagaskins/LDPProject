@extends('layouts.app')

@section('title', 'GitLab Projects')

@section('content')
    <div class="projects-container">
        <h2>GitLab Projects</h2>

        <!-- Таблица с проектами -->
        <table class="projects-table">
            <thead>
            <tr>
                <th>Project Name</th>
                <th>Description</th>
                <th>Visibility</th>
                <th>Web URL</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project['name'] ?? 'N/A' }}</td>
                    <td>{{ $project['description'] ?? 'N/A' }}</td>
                    <td>{{ ucfirst($project['visibility']) }}</td>
                    <td><a href="{{ $project['web_url'] }}" target="_blank">Visit Project</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
