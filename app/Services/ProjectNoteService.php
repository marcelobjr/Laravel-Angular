<?php
/**
 * Created by PhpStorm.
 * User: marce
 * Date: 21/03/2016
 * Time: 22:59
 */

namespace Code\Services;

use \Prettus\Validator\Exceptions\ValidatorException;
use Code\Repositories\ProjectNoteRepository;
use Code\Validators\ProjectNoteValidator;

class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;
    /**
     * @var ProjectNoteValidator
     */
    protected $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {

        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }
        catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }


    }

    public  function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data,$id);
        } catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }
}