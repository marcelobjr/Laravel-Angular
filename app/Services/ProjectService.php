<?php
/**
 * Created by PhpStorm.
 * User: marce
 * Date: 21/03/2016
 * Time: 22:59
 */

namespace Code\Services;

use \Prettus\Validator\Exceptions\ValidatorException;
use Code\Repositories\ProjectRepository;
use Code\Validators\ProjectValidator;
use \Illuminate\Contracts\Filesystem\Factory as Storage;
use \Illuminate\Filesystem\Filesystem;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    protected $validator;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var Storage
     */
    protected $storage;


    /**
     * ProjectService constructor.
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    public function __construct(
        ProjectRepository $repository,
        ProjectValidator $validator,
        Filesystem $filesystem,
        Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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

    public  function destroy($id)
    {

        try{
            $this->repository->delete($id);
            return [
                'error' => false,
                'message' => "Deletado com Sucesso"
            ];
        } catch(Exception $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    /**
     * @param array $data
     */
    public function createFile(array $data)
    {

        $project = $this->repository->skipPresenter()->find($data['project_id']);

        $projectFile = $project->files()->create($data);
        //name
        //project_id
        //description
        //extencion
        //file

        $this->storage->put($data['name'].'.'.$data['extension'], $this->filesystem->get($data['file']));

    }
}