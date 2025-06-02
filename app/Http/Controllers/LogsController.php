<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class LogsController extends Controller
{
    public function index()
    {
        return view('logs');
    }

    public function data()
    {
        date_default_timezone_set('Europe/Riga');

        $project_id = '69719907';
        $access_token = env('GITLAB_ACCESS_TOKEN');
        $base_url = "https://gitlab.com/api/v4/projects/$project_id";

        $pipelinesResponse = Http::withToken($access_token)
            ->get("$base_url/pipelines", ['per_page' => 10]);

        if (!$pipelinesResponse->ok()) {
            return response()->json([], 500);
        }

        $pipelines = $pipelinesResponse->json();
        $logs = [];

        foreach ($pipelines as $pipeline) {
            $pipelineDetailsResponse = Http::withToken($access_token)
                ->get("$base_url/pipelines/{$pipeline['id']}");

            if (!$pipelineDetailsResponse->ok()) {
                continue;
            }

            $details = $pipelineDetailsResponse->json();

            $jobsResponse = Http::withToken($access_token)
                ->get("$base_url/pipelines/{$pipeline['id']}/jobs");

            $jobs = $jobsResponse->ok() ? $jobsResponse->json() : [];

            $failedJobName = null;
            foreach ($jobs as $job) {
                if ($job['status'] === 'failed') {
                    $failedJobName = $job['name'];
                    break;
                }
            }

            $status = $details['status'] ?? $pipeline['status'];
            $level = match ($status) {
                'success' => 'INFO',
                'failed' => 'ERROR',
                'canceled' => 'WARNING',
                default => 'WARNING',
            };

            $message = $status === 'failed' && $failedJobName
                ? "Pipeline #{$pipeline['id']} failed at job: {$failedJobName}"
                : "Pipeline #{$pipeline['id']} status: {$status}";

            $time = $details['updated_at'] ?? $pipeline['updated_at'] ?? $pipeline['created_at'];
            $timeFormatted = date('H:i', strtotime($time));

            $author = $details['user']['name'] ?? 'Unknown';

            $durationSeconds = isset($details['duration']) ? round($details['duration']) : null;
            $duration = $durationSeconds ? gmdate("H:i:s", $durationSeconds) : '—';

            $ref = $details['ref'] ?? $pipeline['ref'] ?? 'unknown';

            $logs[] = [
                'time' => $timeFormatted,
                'level' => $level,
                'service' => $ref,
                'message' => $message,
                'author' => $author,
                'duration' => $duration,
            ];
        }

        return response()->json($logs);
    }
}
