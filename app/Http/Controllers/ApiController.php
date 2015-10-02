<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * Error creating user token
     *
     * @param string $message
     * @return array
     */
    public function respondCannotCreateToken($message = 'Cannot Create Token')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * No results/records found
     *
     * @param string $message
     * @return array
     */
    public function respondNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Respond for user exist
     *
     * @param string $message
     * @return array
     */
    public function respondUserExist($message = 'User already exist')
    {
        return $this->setStatusCode(409)->respondWithError($message);
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
}
