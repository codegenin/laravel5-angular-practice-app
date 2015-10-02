<?php

namespace App\Http\Controllers;

use App\Cortejando\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateController extends ApiController
{
    /**
     * Authenticate a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->respondInvalidCredential();
            }
        } catch (JWTException $e) {
            // something went wrong
            return $this->respondCannotCreateToken();
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    /**
     * Process user registration
     *
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        $registerData = [
            'name'      => $request->input('name'),
            'description' => $request->input('description'),
            'dob'       => $request->input('dob'),
            'phone'     => $request->input('phone'),
            'gender'     => $request->input('gender'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
        ];

        // Inline validation - @TODO - transfer to validator class maybe
        // Must not already exist in the `email` column of `users` table
        $rules      = ['email' => 'unique:users,email'];
        $validator  = Validator::make($registerData, $rules);

        // If validator fails
        if ($validator->fails()) {
            return $this->respondUserExist();
        }

        // Proceed
        $user   = User::create($registerData);
        $token  = JWTAuth::fromUser($user);

        return response()->json(compact('token'));

    }
}
