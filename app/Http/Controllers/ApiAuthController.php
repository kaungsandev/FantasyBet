<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{
    // require email and password
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required|min:8',
            ]);
            if (! Auth::attempt(request(['email', 'password']))) {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Unauthorized: Email and password do not match our records.',
                ], 401);
            }
            $user = User::where('email', $request->email)->first();

            if (! Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }
            $tokenResult = $user->createToken(time())->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'message' => 'success',
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 200);
        } catch (ValidationException $error) {
            return response()->json([
                'status_code' => $error,
                'error' => $error->getMessage(),
                'message' => 'Something went wrong. Please contact developer.',
            ], 422);
        }
    }

    public function logout()
    {
        request()->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Success'], 200);
    }
}
