<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PipelineController extends Controller
{
    public function getPipelines()
    {
        $gitlab_url = 'https://gitlab.com/api/v4/projects/';
        $project_id = '69719907';
        $access_token = '#';

        $url = $gitlab_url . $project_id . '/pipelines?private_token=' . $access_token;

        $response = file_get_contents($url);
        $pipelines = json_decode($response, true);

        return view('home', compact('pipelines'));
    }
}
