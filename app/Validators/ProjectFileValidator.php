<?php

namespace SisCentral\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator {

    protected $rules = [
        'project_id' => 'required',
        'name' => 'required',
        'file' => 'required|mines:jpg,jpeg,png,git,pdf,zip',
        'description' => 'required',
   ];

}