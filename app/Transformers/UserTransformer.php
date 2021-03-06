<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class UserTransformer extends TransformerAbstract
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
    public function transform($user)
    {
        return [
            'id'            => $user->id,
            'name'          => $user->name,
            'description'   => $user->description,
            'dob'           => $user->dob,
            'phone'         => $user->phone,
            'gender'        => $user->gender
        ];
    }

}
