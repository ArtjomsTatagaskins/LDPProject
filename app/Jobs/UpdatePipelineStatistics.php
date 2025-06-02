<?php

namespace App\Jobs;

use App\Models\PipelineStatistic;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePipelineStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $range;

    public function __construct(string $range = 'day')
    {
        $this->range = $range;
    }

    public function handle()
    {
        date_default_timezone_set('Europe/Riga');

        $projectId = '69719907';
        $accessToken = env('GITLAB_ACCESS_TOKEN');

        switch ($this->range) {
            case 'month':
                $startDate = date('Y-m-d', strtotime('-30 days'));
                break;
            case 'week':
                $startDate = date('Y-m-d', strtotime('-7 days'));
                break;
            case 'day':
            default:
                $startDate = date('Y-m-d', strtotime('-1 day'));
                break;
        }
        $endDate = date('Y-m-d');

        $params = [
            'per_page' => 50,
            'updated_after' => $startDate . 'T00:00:00Z',
            'updated_before' => $endDate . 'T23:59:59Z',
        ];

        $client = new Client([
            'headers' => [
                'PRIVATE-TOKEN' => $accessToken,
            ],
        ]);

        $response = $client->get("https://gitlab.com/api/v4/projects/{$projectId}/pipelines", [
            'query' => $params
        ]);
        $pipelines = json_decode($response->getBody()->getContents(), true);

        $promises = [];
        foreach ($pipelines as $pipeline) {
            $promises[$pipeline['id']] = $client->getAsync("https://gitlab.com/api/v4/projects/{$projectId}/pipelines/{$pipeline['id']}");
        }

        $results = Utils::settle($promises)->wait();

        $success = 0;
        $failed = 0;
        $running = 0;
        $totalDuration = 0;
        $count = 0;
        $history = [];

        foreach ($results as $id => $result) {
            if ($result['state'] === 'fulfilled') {
                $details = json_decode($result['value']->getBody()->getContents(), true);

                $status = $details['status'] ?? 'unknown';
                $durationSeconds = $details['duration'] ?? null;
                $createdAt = $details['created_at'] ?? null;

                switch ($status) {
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
        }

        usort($history, fn($a, $b) => $a['sort_date'] <=> $b['sort_date']);
        $history = array_slice($history, -100);

        $averageDeploymentTimeMinutes = $count > 0 ? round(($totalDuration / $count) / 60, 2) : 0;

        $data = [
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

        PipelineStatistic::updateOrCreate(
            ['range' => $this->range],
            ['data' => json_encode($data)]
        );
    }
}
