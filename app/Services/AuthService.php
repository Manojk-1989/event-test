<?php

namespace App\Services;

use App\Events\PasswordResetRequested;
use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * Register a new user and generate authentication token.
     */
    public function register(array $data): JsonResponse
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Dispatch user registered event
        UserRegistered::dispatch($user);

        // Generate authentication token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful.',
            'data' => [
                'user'  => $user,
                'token' => $token,
            ],
        ], 201);
    }

    /**
     * Authenticate user credentials and generate authentication token.
     */
    public function login(array $data): JsonResponse
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        // Generate authentication token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'user'  => $user,
                'token' => $token,
            ],
        ]);
    }

    /**
     * Logout the authenticated user by revoking the current access token.
     */
    public function logout(User $user): JsonResponse
    {
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
        ]);
    }

    /**
     * Send password reset token to the user's email.
     */
    public function forgotPassword(array $data): JsonResponse
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        // Generate password reset token
        $token = Str::random(64);

        // Remove existing reset token
        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->delete();

        // Store hashed reset token
        DB::table('password_reset_tokens')->insert([
            'email'      => $user->email,
            'token'      => Hash::make($token),
            'created_at' => now(),
        ]);

        // Dispatch password reset event
        PasswordResetRequested::dispatch($user, $token);

        return response()->json([
            'success' => true,
            'message' => 'Password reset token has been sent to your email.',
        ]);
    }

    /**
     * Reset user password using a valid password reset token.
     */
    public function resetPassword(array $data): JsonResponse
    {
        $reset = DB::table('password_reset_tokens')
            ->where('email', $data['email'])
            ->first();

        if (!$reset) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid reset request.',
            ], 400);
        }

        // Verify reset token
        if (!Hash::check($data['token'], $reset->token)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token.',
            ], 400);
        }

        // Check token expiration
        if (now()->diffInMinutes($reset->created_at) > 60) {
            return response()->json([
                'success' => false,
                'message' => 'Token has expired.',
            ], 400);
        }

        $user = User::where('email', $data['email'])->first();

        // Update user password
        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        // Remove used reset token
        DB::table('password_reset_tokens')
            ->where('email', $data['email'])
            ->delete();

        // Revoke all existing authentication tokens
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully.',
        ]);
    }

    /**
     * Retrieve the authenticated user's details.
     */
    public function me(User $user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }
}