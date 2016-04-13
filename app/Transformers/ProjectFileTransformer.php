<?php

namespace Code\Transformers;

use League\Fractal\TransformerAbstract;
use Code\Entities\ProjectFile;

/**
 * Class ProjectFileTransformer
 * @package namespace Code\Transformers;
 */
class ProjectFileTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectFile entity
     * @param \ProjectFile $model
     *
     * @return array
     */
    public function transform(ProjectFile $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'extension'  => $model->extension,
            'description'=> $model->description
            

            /* place your other model properties here */

            //'created_at' => $model->created_at,
            //'updated_at' => $model->updated_at
        ];
    }
}
