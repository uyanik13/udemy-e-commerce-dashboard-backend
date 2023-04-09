<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLogoutRequest;

class AuthController extends ApiController
{
    /**
     * Create User
     * @param UserRegisterRequest $request
     * @return User
     */
    public function register(UserRegisterRequest $request)
    {
        try {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user_data' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param UserLoginRequest $request
     * @return User
     */
    public function login(UserLoginRequest $request)
    {
        try {

            if (Auth::attempt($request->only(['email', 'password']))) {
                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'user_data' => $user,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }

            return $this->responseUnprocessable(['email_or_password' => 'Email & Password does not match with our record']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        $user = User::find($request->user['id']);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        try {
            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Logged Out Successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


}
