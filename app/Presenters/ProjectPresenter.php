<?php
namespace Code\Presenters;

use Code\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjectPresenter
 * @package Code\Presenters
 */
class ProjectPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectTransformer();
    }

}