<?php

namespace App\Repositories;

use App\Exceptions\AuthException;
use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthInterface;
use App\Models\User;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthRepository  implements AuthInterface
{
    /**
     * User login
     */
    public function login(LoginRequest $request): object
    {
        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return returnResponse('Failed', ['Email & Password does not match with our record.'], Response::HTTP_UNAUTHORIZED);
            }
            $user = User::where('email', $request->email)->first();
            $data = [
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ];

            return returnResponse('Success', $data, Response::HTTP_OK);
        } catch (Throwable $e) {
            throw new AuthException($e);
        }
    }
    /**
     * User logout
     */
    public function logout(Request $request): object
    {
        auth()->user()->tokens()->delete();

        return returnResponse('Success', ['logged out successfully '], Response::HTTP_OK);
    }
}
