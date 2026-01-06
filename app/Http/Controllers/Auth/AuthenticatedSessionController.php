<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JSONResponse
    {
        $request->authenticate();

        $user = Auth::user();
        if ($user->two_factor_code && $user->two_factor_expires_at && Carbon::now() < Carbon::parse($user->two_factor_expires_at)) {
            return response()->json([
                'message' => __('Two-factor authentication is required.'),
                'user_id' => $user->id
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user->generateTwoFactorCode();
        if(!app()->environment('local')) {
            Mail::to($user->email)->send(new TwoFactorCodeMail($user));
        }
        // $user->session()->regenerate();

        return response()->json([
            'message' => __('Two-factor code sent to your email.'),
            'user_id' => $user->id
        ], Response::HTTP_OK);

    }

    public function verifyTwoFactor(Request $request) : JSONResponse
    {
        $request->validate([
            'user_id' => 'required',
            'code' => 'required'
        ]);

        $user = User::findOrFail($request->user_id);

        if (
            $user->two_factor_code !== $request->code ||
            $user->two_factor_expires_at->isPast()
        ) {
            return response()->json(['message' => __('Invalid two-factor code')], Response::HTTP_UNAUTHORIZED);
        }

        $user->resetTwoFactorCode();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ], Response::HTTP_OK);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
