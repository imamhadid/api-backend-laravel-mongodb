<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService implements AuthServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $user = $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return $user;
    }

    public function login(array $credentials)
    {

        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user['password'])) {
            return false;
        }

        try {
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                return ['error' => 'Invalid credentials'];
            }
            return $token;
        } catch (JWTException $e) {
            return ['error' => 'Failed to create token'];
        }
    }
}

