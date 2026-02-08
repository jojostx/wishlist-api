<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * Authenticate a user and return a Sanctum token with the user profile.
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $credentials['email'])->first();

        return $this->success([
            'user' => new UserResource($user),
            'token' => $user->createToken('API Token')->plainTextToken,
        ]);
    }

    /**
     * Register a new user and return a Sanctum token with the user profile.
     */
    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $this->success([
            'user' => new UserResource($user),
            'token' => $user->createToken('API Token')->plainTextToken,
        ]);
    }

    /**
     * Revoke the current access token for the authenticated user.
     */
    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();

        if ($token && method_exists($token, 'delete')) {
            $token->delete();
        }

        return $this->success([
            'message' => 'You have successfully been logged out and your token has been deleted',
        ]);
    }
}
