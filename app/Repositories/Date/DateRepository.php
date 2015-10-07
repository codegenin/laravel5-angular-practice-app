<?php

namespace App\Repositories\Date;


/**
 * Interface DateRepository
 * @package App\Repositories\Date
 */
interface DateRepository
{
    public function getActiveDatesNotOwnedByUser($userId);
}