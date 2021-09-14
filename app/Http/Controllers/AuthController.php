<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view("/");
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            "git_email" => "required|email",
            "password" => "required|min:6"
        ]);
        $git_users = User::where("git_email", $data["git_email"])->first();
        if (!$git_users || !Hash::check($data["password"], $git_users->password)) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ], 401);
        } else {
            $token = $git_users->createToken("github_user_api")->plainTextToken;
            $response = [
                "user" => $git_users,
                "token" => $token
            ];
            return response($response, 200);
        }
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            "git_username" => "required",
            "git_email" => "required|email|unique:users",
            "password" => "required|min:6"
        ]);
        $git_users = User::create([
            "git_username" => $data["git_username"],
            "git_email" => $data["git_email"],
            "password" => Hash::make($data["password"])
        ]);
        $token = $git_users->createToken("github_user_api")->plainTextToken;
        $response = [
            'users' => $git_users,
            'token' => $token
        ];
        return response($response, 201);
    }
}
