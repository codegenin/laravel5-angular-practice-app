<?php

namespace App\Http\Controllers;

use App\Date;
use App\Transformers\DateTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DateController extends ApiController
{
    protected $dateTransformer;

    /**
     * DateController constructor.
     *
     * @param DateTransformer $dateTransformer
     */
    public function __construct(DateTransformer $dateTransformer)
    {
        /*
         * Apply the jwt.auth middleware
         */
        $this->middleware('jwt.auth'); // Enable auth for all methods

        $this->dateTransformer = $dateTransformer;
    }

    /**
     * Display a listing of the dates.
     *
     * @return \Illuminate\Http\Response
     */
    public function listDates()
    {
        $user = Auth::user()->id;

        $dates = Date::where('state', 'active')->where('owner_id', $user)
            ->paginate();

        return response()->json([
            'data' => Fractal::collection($dates, new DateTransformer())
                ->responseJson(Response::HTTP_ACCEPTED)
        ]);
    }

    /**
     * Display the specified date.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDate($id)
    {
        // Check if we have a user
        if(! $date = Date::find($id)) {
            return $this->respondNotFound('Date data not found'); // Not found
        }

        // Return the user data
        return response()->json([
            'data'   => Fractal::item($date, new DateTransformer())
                ->responseJson(Response::HTTP_ACCEPTED)
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
