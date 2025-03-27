<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'repository_url' => 'required|url|max:255',
            'demo_url' => 'nullable|url|max:255',
            'user_id' => 'required|exists:users,id'
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no debe superar los 200 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'Las imágenes permitidas son JPEG, PNG, JPG y WEBP.',
            'repository_url.required' => 'El enlace del repositorio es obligatorio.',
            'repository_url.url' => 'El enlace del repositorio debe ser una URL válida.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no es válido.'
        ]);

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
            'project' => $project
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
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'repository_url' => 'required|url|max:255',
            'demo_url' => 'nullable|url|max:255'
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no debe superar los 200 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'Las imágenes permitidas son JPEG, PNG, JPG y WEBP.',
            'repository_url.required' => 'El enlace del repositorio es obligatorio.',
            'repository_url.url' => 'El enlace del repositorio debe ser una URL válida.'
        ]);

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
