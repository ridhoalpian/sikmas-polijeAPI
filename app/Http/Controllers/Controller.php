<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function register(Request $request)
    {
        $akun = User::create($request->all());
        return response()->json(['message' => 'Success', 'data' => $akun]);
    }

    public function loginApi(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($loginData)) {
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            return response()->json([
                'data' => Auth::user(),
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid Credentials',
        ], 400);
    }

    public function getUserData(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json([
                'emailUKM' => $user->email,
                'namaUKM' => $user->name,
            ]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
