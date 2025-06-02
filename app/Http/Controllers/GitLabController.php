<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class GitLabController extends Controller
{
    public function getProjects()
    {
        // Токен доступа к GitLab
        $accessToken = env('GITLAB_ACCESS_TOKEN');

        $response = Http::withHeaders([
            'PRIVATE-TOKEN' => $accessToken,
        ])->get('https://gitlab.com/api/v4/projects', [
            'owned' => false,
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Unable to fetch projects'], 500);
        }

        $projects = $response->json();

        return view('home', compact('projects'));
    }
}

