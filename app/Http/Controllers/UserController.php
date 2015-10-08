<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Repositories\User\DbUserRepository;
use App\Repositories\User\userRepo;
use App\Transformers\UserTransformer;
use App\User;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ApiController
{
    /**
     * @var Fractal
     */
    protected $userTransformer;
    /**
     * @var userRepo
     */
    private $userRepo;

    /**
     * UserController constructor.
     * @param UserTransformer  $userTransformer
     * @param DbUserRepository $userRepository
     */
    public function __construct(UserTransformer $userTransformer, DbUserRepository $userRepository)
    {
        /*
         * Apply the jwt.auth middleware
         */
        $this->middleware('jwt.auth', [
            'except' => ['logout']
            // Do not enable auth on this methods
        ]);

        $this->userTransformer = $userTransformer;
        $this->userRepo        = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = $this->userRepo->paginate(10);

        return response()->json([
            'data' => Fractal::collection($users, new UserTransformer())
                             ->responseJson(Response::HTTP_ACCEPTED)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getUser($id)
    {
        // Check if we have a user
        if (!$user = $this->userRepo->find($id)) {
            return $this->respondNotFound('User data not found'); // Not found
        }

        // Return the user data
        return response()->json([
            'data' => Fractal::item($user, new UserTransformer())
                             ->responseJson(Response::HTTP_ACCEPTED)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function editUser()
    {
        $user = $this->getAuthenticatedUser();

        return Fractal::item($user, new UserTransformer())
                      ->responseJson(Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\Response
     * @internal param UserUpdateRequest|Request $request
     * @internal param int $id
     */
    public function updateUser(UserUpdateRequest $request)
    {
        $user = $this->userRepo->find($request->input('id'));
        $user->update($request->all());

        return $this->respondRecordUpdated('User has been updated');
    }

}
