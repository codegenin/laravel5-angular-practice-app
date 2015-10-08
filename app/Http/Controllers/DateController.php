<?php

namespace App\Http\Controllers;

use App\Repositories\Date\DbDateRepository;
use App\Transformers\DateTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DateController extends ApiController
{
    protected $dateTransformer;
    /**
     * @var DbDateRepository
     */
    private $dateRepo;

    /**
     * DateController constructor.
     *
     * @param DateTransformer  $dateTransformer
     * @param DbDateRepository $dateRepository
     */
    public function __construct(DateTransformer $dateTransformer, DbDateRepository $dateRepository)
    {
        /*
         * Apply the jwt.auth middleware
         */
        $this->middleware('jwt.auth'); // Enable auth for all methods

        $this->dateTransformer = $dateTransformer;
        $this->dateRepo        = $dateRepository;
    }

    /**
     * Display a listing of the dates.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListDates()
    {
        $user  = Auth::user(); //jwt-auth package supports Laravel Auth
        $dates = $this->dateRepo->getActiveDatesNotOwnedByUser($user->id);

        return response()->json([
            'data' => Fractal::collection($dates, new DateTransformer())
                             ->responseJson(Response::HTTP_ACCEPTED)
        ]);
    }

    /**
     * Display the specified date.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getDate($id)
    {
        // Check if we have a user
        if (!$date = $this->dateRepo->find($id)) {
            return $this->respondNotFound('Date data not found'); // Not found
        }

        // Return the user data
        return response()->json([
            'data' => Fractal::item($date, new DateTransformer())
                             ->responseJson(Response::HTTP_ACCEPTED)
        ]);
    }
}
