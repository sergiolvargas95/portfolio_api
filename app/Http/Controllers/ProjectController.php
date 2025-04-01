<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Project::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        } else {
            $imagePath = $request->image;
        }

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'repository_url' => $request->repository_url,
            'demo_url' => $request->demo_url,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'message' => 'The Project has been created Successfully',
            'data' => $project
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json($project, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        } else {
            $imagePath = $project->image;
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'repository_url' => $request->repository_url,
            'demo_url' => $request->demo_url,
        ]);

        return response()->json([
            'message' => 'The Project has been updated Successfully',
            'project' => $project
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'The project with id '. $project->id .' has been deleted'
        ],204);
    }
}
