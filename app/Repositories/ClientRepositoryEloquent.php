<?php

namespace Code\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Code\Repositories\ClientRepository;
use Code\Entities\Client;
use Code\Validators\ClientValidator;
use Code\Presenters\ClientPresenter;

/**
 * Class ClientRepositoryEloquent
 * @package namespace SisCentral\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    protected $fieldSearchable = [
    'name'
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ClientValidator::class;
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
        return ClientPresenter::class;
    }
}
