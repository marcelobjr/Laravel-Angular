<?php

namespace Code\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Code\Repositories\UserRepository;
use Code\Entities\User;
use Code\Validators\UserValidator;
use Code\Presenters\UserPresenter;


/**
 * Class UserRepositoryEloquent
 * @package namespace SisCentral\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return ProjectPresenter
     */
    public function presenter()
    {
        return UserPresenter::class;
    }
}
