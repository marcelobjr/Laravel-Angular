<?php

namespace SisCentral\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator {

    protected $rules = [
        'name' => 'required|max:255'
   ];

}