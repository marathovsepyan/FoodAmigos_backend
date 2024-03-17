<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signUp(StoreUserRequest $request)
    {
        User::create($request->validated());

        return response('');
    }

    public function issueToken(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $token = Auth::user()->createToken('local');

            return ['token' => $token->plainTextToken];
        }

        return response()->json([
            'error' => 'UnAuthenticated'
        ], 401);
    }
}
