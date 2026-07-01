<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Events\UserRegistered;

class ParticipantService
{
    /**
     * Register a new user.
     */
    public function registerParticipant(array $data): JsonResponse
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Trigger the event
    UserRegistered::dispatch($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful.',
            'data' => [
                'user'  => $user,
                'token' => $token,
            ]
        ], 201);
    }

    
}