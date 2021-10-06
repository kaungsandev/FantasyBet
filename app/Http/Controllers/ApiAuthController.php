<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login (){
        
        validator(request()->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:6',])->validate();
            try {
                $user = User::where('email',request('email'))->first();
                
                if(Hash::check(request('password'), $user->getAuthPassword())){
                    return [
                        'token' => $user->createToken(time())->plainTextToken
                    ];
                }else{
                    return response()->json(['message' => 'Unauthenticated.'], 401);
                }
            } catch (\Throwable $th) {
                return response()->json(['message' => 'User Not Found'], 404,);
            }
        }
        public function logout(){
            request()->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Success'], 200);
        }
    }
    