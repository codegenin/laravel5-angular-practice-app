<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class DateTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var  array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var  array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var  object
     * @return array
     */
    public function transform($date)
    {
        return [
            'id'             => $date->id,
            'description'    => $date->description,
            'time_timestamp' => Carbon::parse($date->time)
                                      ->format(config('cortejando.timestamp_format')),
            'location_name'  => $date->location_name,
            'state'          => $date->state
        ];
    }

}
