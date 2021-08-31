<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view("/");
    }
    public function login(Request $request)
    {
    }
    public function register(Request $request)
    {
    }
}
