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
    protected $defaultIncludes =['members','client'];

    /**
     * @param Project $model
     * @return array
     */
    public function transform(Project $model)
    {
        return [
            'id'     => (int) $model->id,
            'name'   => $model->name,
            'client_id'   => $model->client_id,
            'owner_id'   => (int) $model->owner_id,
            'description'   => $model->description,
            'progress'   => (int) $model->progress,
            'status'   => (int) $model->status,
            'due_date'   => $model->due_date,
            'is_member' => $model->owner_id != \Authorizer::getResourceOwnerId()



            /* place your other model properties here */

            //'created_at' => $model->created_at,
            //'updated_at' => $model->updated_at
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }
}