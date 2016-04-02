<?php

namespace Code\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Client extends Model implements Transformable
{

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    use TransformableTrait;

    protected $fillable = [
        'name',
        'responsible',
        'email',
        'phone',
        'address',
        'obs'
    ];

}
