<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('users', 'public');
        } else {
            $photoPath = $user->photo;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'photo' => $photoPath,
            'profesional_degree' => $request->profesional_degree
        ]);

        return response()->json([
            'message' => 'The User has been updated Successfully',
            'user' => $user
        ], 200);
    }
}
