<?php

namespace App\Repositories\Date;


/**
 * Interface DateRepository
 * @package App\Repositories\Date
 */
interface DateRepositoryInterface
{
    public function getActiveDatesNotOwnedByUser($userId);
}