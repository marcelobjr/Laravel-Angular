<?php
/**
 * Created by PhpStorm.
 * User: marce
 * Date: 26/03/2016
 * Time: 16:51
 */

namespace Code\Transformers;

use Code\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 * Class ProjectTransformer
 * @package Code\Transformers
 */
class ProjectMemberTransformer extends TransformerAbstract
{
    /**
     * @param ProjectMember $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'member_id'     => (int) $model->id,
            'member_name'     => $model->name,


            /* place your other model properties here */

            //'created_at' => $model->created_at,
            //'updated_at' => $model->updated_at
        ];
    }
}