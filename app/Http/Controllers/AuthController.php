<?php

namespace App\Http\Controllers;

use App\Services\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function notAuthenticated()
    {
        return response()->json([
            'statusCode' => 401,
            'message' => 'unauthorized'
        ], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 422,
                'error' => $validator->errors()
            ], 422);
        }

        $data = $request->only('name', 'email', 'password');

        $user = $this->authService->register($data);

        return response()->json([
            'statusCode' => 201,
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 422,
                'error' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        $token = $this->authService->login($credentials);

        if (!$token) {
            return response()->json([
                'statusCode' => 401,
                'error' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'statusCode' => 201,
            'token' => $token
        ]);
    }
}
