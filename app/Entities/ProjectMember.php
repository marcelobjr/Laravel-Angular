<?php

namespace Code\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectMember extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'project_memberss';

    protected $fillable = [
        'project_id',
        'member_id'
    ];



}
