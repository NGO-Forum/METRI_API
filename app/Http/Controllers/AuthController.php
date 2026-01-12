<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    /**
     * Admin Login (Seeder Admin)
     * POST /api/admin/login
     */
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt authentication
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = Auth::user();

        // Allow ADMIN ONLY
        if ($user->role !== 'admin') {
            Auth::logout();

            return response()->json([
                'status' => false,
                'message' => 'Admin access only',
            ], 403);
        }

        // 🔐 Create Sanctum token
        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ]);
    }

    /**
     * Admin Reset Password
     * POST /api/admin/reset-password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => 'Invalid or expired reset token.',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Password reset successful',
        ]);
    }


    /**
     * Admin Forgot Password
     * POST /api/admin/forgot-password
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $user = \App\Models\User::where('email', $request->email)
                ->where('role', 'admin')
                ->first();

            if ($user) {
                Password::sendResetLink(['email' => $user->email]);
            }

            return response()->json([
                'status' => true,
                'message' => 'If the email exists, a reset link has been sent.',
            ]);
        } catch (\Throwable $e) {

            Log::error('FORGOT PASSWORD ERROR', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Mail system error. Check server logs.',
            ], 500);
        }
    }



    /**
     * Admin Logout
     * POST /api/admin/logout
     */
    public function logout(Request $request)
    {
        if ($request->user()?->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully',
        ]);
    }
}
