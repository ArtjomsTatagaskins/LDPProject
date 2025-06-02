@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="settings-page">
        <h2>Settings</h2>

        <div class="settings-columns">
            <div class="settings-column">
                <div class="settings-group">
                    <h3>User Management</h3>
                    <div class="settings-buttons">
                        <button class="settings-button">Manage Roles</button>
                        <button class="settings-button">Add User</button>
                    </div>
                </div>

                <div class="settings-group">
                    <h3>Pipeline Behavior</h3>
                    <div class="settings-buttons">
                        <button class="settings-button">Thresholds</button>
                        <button class="settings-button">Retry Rules</button>
                        <button class="settings-button">Health Checks</button>
                    </div>
                </div>

                <div class="settings-group">
                    <h3>Alerts & Monitoring</h3>
                    <div class="settings-buttons">
                        <button class="settings-button">Thresholds</button>
                        <button class="settings-button">Notifications</button>
                    </div>
                </div>
            </div>

            <div class="settings-column">
                <div class="settings-group">
                    <h3>Integrations</h3>
                    <div class="settings-buttons">
                        <button class="settings-button">GitLab</button>
                        <button class="settings-button">Grafana</button>
                        <button class="settings-button">Slack</button>
                        <button class="settings-button">Docker Registry</button>
                        <button class="settings-button">Dockup</button>
                    </div>
                </div>

                <div class="settings-group">
                    <h3>Display</h3>
                    <div class="settings-buttons">
                        <button class="settings-button">Language</button>
                        <button class="settings-button">Theme</button>
                    </div>
                </div>

                <div class="settings-group">
                    <h3>System Info</h3>
                    <div class="settings-buttons">
                        <button class="settings-button">Version</button>
                        <button class="settings-button">Backup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
