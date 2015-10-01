<?php

namespace App\Http\Controllers;

use App\Cortejando\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends ApiController
{
    /*
     * @var App\Cortejando\Transformers\UserTransformer
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
            'except' => ['create','store','logout'] // Do not enable auth on this methods
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
        $users = User::all();
        return response()->json([
            'data' => $this->userTransformer->transformCollection($users->toArray())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
           'data'   => $this->userTransformer->transform($user)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
