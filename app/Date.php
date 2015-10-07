<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $dates = ['time']; // initialize `time` as Carbon instance
}
