<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function view()
    {
        $data = [
            'deploymentTime' => 10.2,
            'testCoverage' => 82,
            'successRate' => 96,
            'history' => [
                ['date' => 'Mar 23', 'time' => 6],
                ['date' => 'Mar 28', 'time' => 5],
                ['date' => 'Apr 3', 'time' => 10],
                ['date' => 'Apr 7', 'time' => 8],
                ['date' => 'Sept', 'time' => 7],
            ],
            'substatus' => [
                'Success' => 70,
                'Failed' => 25,
                'Running' => 5,
            ]
        ];
        return view('statistics', compact('data'));
    }
}
