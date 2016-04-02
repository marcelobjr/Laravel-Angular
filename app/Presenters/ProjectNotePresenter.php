<?php

namespace Code\Presenters;

use Code\Transformers\ProjectNoteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjectNotePresenter
 *
 * @package namespace Code\Presenters;
 */
class ProjectNotePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectNoteTransformer();
    }
}
