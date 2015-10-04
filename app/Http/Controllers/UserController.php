<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Transformers\UserTransformer;
use App\User;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ApiController
{
    /*
     * @var Fractal
     */
    protected $userTransformer;

    /**
     * UserController constructor.
     * @param UserTransformer $userTransformer
     */
    public function __construct(UserTransformer $userTransformer)
    {
        /*
         * Apply the jwt.auth middleware
         */
        $this->middleware('jwt.auth', [
            'except' => ['logout'] // Do not enable auth on this methods
        ]);

        $this->userTransformer = $userTransformer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return response()->json([
            'data' => Fractal::collection($users, new UserTransformer())
                ->responseJson(Response::HTTP_ACCEPTED)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Check if we have a user
        if(! $user = User::find($id)) {
            return $this->respondNotFound('User data not found'); // Not found
        }

        // Return the user data
        return response()->json([
           'data'   => Fractal::item($user, new UserTransformer())
            ->responseJson(Response::HTTP_ACCEPTED)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit()
    {
        $user = Auth::user();
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
    public function update(UserUpdateRequest $request)
    {
        $user = User::findOrFail($request->input('id'));
        $user->update($request->all());

        return $this->respondRecordUpdated('User has been updated');
    }

}
