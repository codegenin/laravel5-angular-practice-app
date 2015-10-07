<?php

namespace App\Repositories\Date;

use App\Date;
use App\Repositories\DbRepository;

/**
 * Class DbDateRepository
 * @package App\Repositories\Date
 */
class DbDateRepository extends DbRepository implements DateRepository
{
    /**
     * @var Date
     */
    protected $model;

    /**
     * DbDateRepository constructor.
     * @param Date $model
     */
    public function __construct(Date $model)
    {
        $this->model = $model;
    }


    /**
     * Return the active dates
     * which are not owned by the current logged in user
     *
     * @param $userId
     * @return mixed
     */
    public function getActiveDatesNotOwnedByUser($userId)
    {
        return $this->model->where('state', 'active')
            ->where('owner_id', '<>', $userId)
            ->paginate();
    }
}