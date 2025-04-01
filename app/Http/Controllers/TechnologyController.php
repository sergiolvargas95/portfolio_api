<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Technology::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('technologies', 'public');
        } else {
            $imagePath = $request->image;
        }

        $technology = Technology::create([
            'title' => $request->title,
            'image' => $imagePath,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'message' => 'The Technology has been created Successfully',
            'data' => $technology
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return response()->json($technology, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        } else {
            $imagePath = $technology->image;
        }

        $technology->update([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return response()->json([
            'message' => 'The Technology has been updated Successfully',
            'technology' => $technology
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return response()->json([
            'message' => 'The technology with id '. $technology->id .' has been deleted'
        ],204);
    }
}
