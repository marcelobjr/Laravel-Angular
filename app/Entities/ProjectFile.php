<?php

namespace Code\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var string
     */
    protected $table = 'project_files';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'extension'
    ];

    public function getFileName(){
        return $this->id .'.'. $this->extension;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
