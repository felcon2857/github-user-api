<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view("/");
    }
    public function login(Request $request)
    {
        return response()->json('login');
    }
    public function register(Request $request)
    {
        $validate = Validator::make(request()->all(), [
            'git_username' => 'required',
            'git_email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'registration_validation_error',
                'errors' => $validate->errors()
            ], 422);
        }
        $git_users = new User();
        $git_users->git_username = $request["git_username"];
        $git_users->git_email = $request["git_email"];
        $git_users->password = Hash::make($request["password"]);
        if ($git_users->save()) {
            return response()->json([
                'message' => 'registration_validation_success',
                'users' => $git_users->toArray()
            ], 200);
        } else {
            return response()->json([
                'message' => 'registration_validation_failed',
                'error' => $git_users->errors()
            ], 500);
        }
    }
}
