<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function registerUser(RegisterUserRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken("API TOKEN")->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'user' => $user
        ], 201)->header('Authorization', 'Bearer ' . $token);
    }

    public function loginUser(LoginUserRequest $request) {
        if(!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email & Password do not match with our records'
            ], 401);
        }

        $user = User::where('email', $request->email)
            ->select('id', 'email', 'name')
            ->first();

        $token = $user->createToken("API TOKEN")->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User logged in Successfuly',
            'user' => $user
        ], 200)->header('Authorization', 'Bearer' . $token);
    }
}
