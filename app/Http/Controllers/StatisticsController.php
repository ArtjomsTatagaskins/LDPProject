<?php

namespace App\Http\Controllers;
use App\Models\PipelineStatistic;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
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
        $range = request()->query('range', 'day');
        $data = $this->fetchStatisticsData($range);
        return response()->json($data);
    }

    public function fetchStatisticsData(string $range = 'day')
    {
        $record = PipelineStatistic::where('range', $range)->first();
        if (!$record) {
            // Если нет, можно вернуть пустую структуру или запустить Job синхронно (не рекомендуется)
            return [
                'deploymentTime' => 0,
                'testCoverage' => 0,
                'successRate' => 0,
                'history' => [],
                'substatus' => ['Success' => 0, 'Failed' => 0, 'Running' => 0],
            ];
        }
        return json_decode($record->data, true);
    }
}
