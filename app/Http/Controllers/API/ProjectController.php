<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->orderByDesc('id')->paginate();
        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }

    public function show($slug)
    {
        $project = Project::with('technologies', 'type')->where('slug', $slug)->first();
        if ($project) {
            //retur the object
            return response()->json([
                'success' => true,
                'response' => $project,
            ]);

        } else {
            // 404
            return response()->json([
                'success' => false,
                'response' => 'error 404',
            ]);
        }
    }
}
