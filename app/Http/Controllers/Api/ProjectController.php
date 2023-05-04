<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){

        $results = Project::with('typology', 'technologies')->get();

        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }
    public function show($id)
    {

        $project = Project::where('id', $id)->first();

        $relatedProject = project::where('id', '!=', $id)->orderBy('created_at', 'desc')->limit(3)->get();

        $project->relatedProjects = $relatedProject;

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessun progetto trovato'
            ]);
        }
    }
}
