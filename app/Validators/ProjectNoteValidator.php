<?php

namespace Code\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator {

    protected $rules = [
        'project_id' => 'required|integer',
        'title'  => 'required|max:200',
        'note' => 'required|max:200'
   ];

}