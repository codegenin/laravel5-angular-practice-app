<?php

namespace App\Http\Controllers;

use App\Cortejando\Transformers\UserTransformer;
use App\Http\Requests\UserRegisterRequest;
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
        return $this->responseWithToken($token);
    }

    /**
     * Process user registration
     *
     * @param UserRegisterRequest|Request $request
     * @return array
     */
    public function register(UserRegisterRequest $request)
    {
        // Proceed
        $user   = User::create($request->all());
        $token  = JWTAuth::fromUser($user);

        return $this->responseWithToken($token);
    }
}
