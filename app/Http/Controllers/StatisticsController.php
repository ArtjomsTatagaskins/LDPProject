<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class StatisticsController extends Controller
{
    public function view()
    {
        $data = $this->fetchStatisticsData();
        return view('statistics', compact('data'));
    }

    public function apiData()
    {
        $data = $this->fetchStatisticsData();
        return response()->json($data);
    }

    private function fetchStatisticsData()
    {
        return Cache::remember('gitlab_statistics', 300, function () {
            date_default_timezone_set('Europe/Riga');

            $projectId = '69719907';
            $accessToken = env('GITLAB_ACCESS_TOKEN');

            $response = Http::withHeaders([
                'PRIVATE-TOKEN' => $accessToken,
            ])->get("https://gitlab.com/api/v4/projects/{$projectId}/pipelines", [
                'per_page' => 15,
            ]);

            if ($response->failed()) {
                abort(500, 'Error getting response');
            }

            $pipelines = $response->json();

            $success = 0;
            $failed = 0;
            $running = 0;

            $totalDuration = 0;
            $count = 0;
            $history = [];

            foreach ($pipelines as $pipeline) {
                $pipelineDetailsResponse = Http::withHeaders([
                    'PRIVATE-TOKEN' => $accessToken,
                ])->get("https://gitlab.com/api/v4/projects/{$projectId}/pipelines/{$pipeline['id']}");

                if ($pipelineDetailsResponse->failed()) {
                    continue;
                }

                $details = $pipelineDetailsResponse->json();

                $durationSeconds = $details['duration'] ?? null;
                $createdAt = $details['created_at'] ?? null;

                switch ($pipeline['status']) {
                    case 'success':
                        $success++;
                        if ($durationSeconds) {
                            $totalDuration += $durationSeconds;
                            $count++;
                        }
                        break;
                    case 'failed':
                        $failed++;
                        break;
                    case 'running':
                        $running++;
                        break;
                }

                if ($createdAt && $durationSeconds) {
                    $timestamp = strtotime($createdAt);
                    $history[] = [
                        'display_date' => date('j M H:i', $timestamp),
                        'sort_date' => $timestamp,
                        'time' => round($durationSeconds / 60, 2),
                    ];
                }
            }

            usort($history, function ($a, $b) {
                return $a['sort_date'] <=> $b['sort_date'];
            });

            $history = array_values(array_slice($history, -5, 5, true));

            $averageDeploymentTimeMinutes = $count > 0 ? round(($totalDuration / $count) / 60, 2) : 0;

            return [
                'deploymentTime' => $averageDeploymentTimeMinutes,
                'testCoverage' => 82,
                'successRate' => ($success + $failed + $running) > 0
                    ? round($success / ($success + $failed + $running) * 100)
                    : 0,
                'history' => $history,
                'substatus' => [
                    'Success' => $success,
                    'Failed' => $failed,
                    'Running' => $running,
                ],
            ];
        });
    }
}
