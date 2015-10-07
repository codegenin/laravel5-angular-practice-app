<?php

namespace App\Repositories\User;

use App\Repositories\DbRepository;
use App\User;

/**
 * Class DbUserRepository
 * User repository implementation
 * @package App\Repositories\User
 */
class DbUserRepository extends DbRepository implements UserRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * DbUserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}