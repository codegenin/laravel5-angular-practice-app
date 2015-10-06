<?php

namespace App\Http\Controllers;

use App\Transformers\DateTransformer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DateController extends Controller
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

    }

    /**
     * Display the specified date.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDate($id)
    {
        //
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
