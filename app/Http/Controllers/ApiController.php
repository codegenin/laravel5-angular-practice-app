<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    protected $statusCode;

    /**
     * Get status code
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set status code
     *
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this; // To allow chaining
    }

    /**
     * Invalid email and password respond
     *
     * @param string $message
     * @return array
     */
    public function respondInvalidCredential($message = 'Invalid Credentials')
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)
            ->respondWithError($message);
    }

    /**
     * Error creating user token
     *
     * @param string $message
     * @return array
     */
    public function respondCannotCreateToken($message = 'Cannot Create Token')
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message);
    }

    /**
     * No results/records found
     *
     * @param string $message
     * @return array
     */
    public function respondNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    /**
     * Respond for user exist
     *
     * @param string $message
     * @return array
     */
    public function respondUserExist($message = 'User already exist')
    {
        return $this->setStatusCode(Response::HTTP_CONFLICT)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     * @internal param array $data
     */
    public function respondRecordUpdated($message = 'Records updated successfully.')
    {
        return $this->setStatusCode(Response::HTTP_OK)->respondSuccessful($message);
    }

    /**
     * Display response token
     *
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseWithToken($token)
    {
        return response()->json([
            'token' => $token
        ]);
    }

    /**
     * @param $message
     * @return mixed
     * @internal param $data
     */
    public function respondSuccessful($message)
    {
        return response()->json([
            'success' => [
                'message'   => $message,
                'code'      => $this->getStatusCode()
            ]
        ]);
    }
    /**
     * Display error respond message and status
     *
     * @param $message
     * @return array
     */
    public function respondWithError($message)
    {
        return response()->json([
            'error' => [
                'message'   => $message,
                'code'      => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Get the api authenticated user
     *
     * @return array
     */
    protected function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->respondNotFound('User record not found');
            }
        } catch (JWTException $e) {
            // something went wrong
            return $this->respondInvalidCredential();
        }

        // the token is valid and we have found the user via the sub claim
        return $user;
    }
}
