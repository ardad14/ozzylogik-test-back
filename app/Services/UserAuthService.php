<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserAuthService
{
    public function login(Request $request): array
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return [
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised',
                'code' => 401,
            ];
        }

        $user = Auth::user();
        $token = $user->createToken(config('app.name'));

        $token->token->expires_at = Carbon::now()->addDay();
        $token->token->save();

        $user = Auth::user();

        return [
            'userId' => Auth::id(),
            'role' => $user->role,
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            'code' => 200,
        ];
    }

    public function logout(Request $request): array
    {
        $request->user()->token()->revoke();

        return [
            'message' => 'You are successfully logged out',
        ];
    }
}
