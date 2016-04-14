<?php

namespace Code\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator {

    protected $rules = [
        'project_id' => 'required',
        'name' => 'required',
        'file' => 'required|mimes:jpeg,jpg,gif,bmp,png|max:2048',//2MB
        'description' => 'required'
   ];

}