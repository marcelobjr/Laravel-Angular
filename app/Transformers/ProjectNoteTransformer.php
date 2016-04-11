<?php

namespace Code\Transformers;

use League\Fractal\TransformerAbstract;
use Code\Entities\ProjectNote;

/**
 * Class ProjectNoteTransformer
 * @package namespace Code\Transformers;
 */
class ProjectNoteTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectNote entity
     * @param \ProjectNote $model
     *
     * @return array
     */
    public function transform(ProjectNote $model)
    {
        return [
            'id'         => (int) $model->id,
            'project_id' => (int) $model->project_id,
            'title'      => $model->title,
            'note'       => $model->note

            /* place your other model properties here */

            //'created_at' => $model->created_at,
            //'updated_at' => $model->updated_at
        ];
    }
}
