<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {   
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ]);

    }

    public function login(Request $request)
    {
        if(Auth::attempt($request->only(['email', 'password']))){
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ]);
        }else{
            dd('auth not success');
        }
    }
}
