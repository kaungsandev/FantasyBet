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
                'password' => 'required'
            ]);
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Unauthorized'
                ]);
            }
            // $user = User::all()->where('email', $request->email)->where('email_verified_at', '<>', NULL)->first();
            $user = User::where('email',$request->email)->first();
            // if (!$user) {
            //     return [
            //         'status_code' => 401,
            //         "message" => 'Email is not verified',
            //         "success" => false
            //     ];
            // }

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }
            $tokenResult = $user->createToken(time())->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        } catch (ValidationException $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }
    public function logout()
    {
        request()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Success'], 200);
    }
}
