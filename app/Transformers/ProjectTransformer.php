<?php
/**
 * Created by PhpStorm.
 * User: marce
 * Date: 26/03/2016
 * Time: 16:51
 */

namespace Code\Transformers;

use Code\Entities\Project;
use League\Fractal\TransformerAbstract;

/**
 * Class ProjectTransformer
 * @package Code\Transformers
 */
class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes =['members'];
    /**
     * @param Project $model
     * @return array
     */
    public function transform(Project $model)
    {
        return [
            'project_id'     => (int) $model->id,
            'project_nome'   => $model->name,
            'project_owner'   => (int) $model->owner_id,
            'descricao'   => $model->description,
            'processo'   => (int) $model->progress,
            'status'   => (int) $model->status,


            /* place your other model properties here */

            //'created_at' => $model->created_at,
            //'updated_at' => $model->updated_at
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }
}