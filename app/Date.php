<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    /**
     * Initialize `time` as Carbon instance
     */
    protected $dates = ['time'];

    /**
     * Date belongs to user relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }
}
