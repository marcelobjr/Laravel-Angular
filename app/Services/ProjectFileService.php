<?php
/**
 * Created by PhpStorm.
 * User: Marcelo Barros
 * Date: 21/03/2016
 * Time: 22:59
 */

namespace Code\Services;

use \Prettus\Validator\Exceptions\ValidatorException;
use \Prettus\Validator\Contracts\ValidatorInterface;
use Code\Repositories\ProjectFileRepository;
use Code\Repositories\ProjectRepository;
use Code\Entities\ProjectFile;
use Code\Validators\ProjectFileValidator;
use \Illuminate\Contracts\Filesystem\Factory as Storage;
use \Illuminate\Filesystem\Filesystem;

class ProjectFileService
{
    /**
     * @var ProjectFileRepository
     */
    protected $repository;

    /**
     * @var ProjectRepository
     */
    protected $projectRepository;
    /**
     * @var ProjectFileValidator
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
     * @param ProjectFileRepository $repository
     * @param ProjectRepository $projectRepository
     * @param ProjectFileValidator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    public function __construct(
        ProjectFileRepository $repository,
        ProjectRepository $projectRepository,
        ProjectFileValidator $validator,
        Filesystem $filesystem,
        Storage $storage)
    {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function create(array $data)
    {

        try{
            $this->validator->with($data)->passesOrFail(
                ValidatorInterface::RULE_CREATE);

        $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);
        $this->storage->put($projectFile->getFileName(),
            $this->filesystem->get($data['file']));    

            return $projectFile;
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
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            return $this->repository->update($data,$id);
        } catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public  function delete($id)
    {

        $projectFile = $this->repository->skipPresenter()->find($id);
        $arquivo = $projectFile->getFileName();
        if($this->storage->exists($arquivo)){
            $this->storage->delete($arquivo);
            $projectFile->delete();
        }

    }

    /**
     * @param array $id
     */
    public function getFilePath($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseURL($projectFile);
    }

    public function getFileName($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $projectFile->getFileName();
    }


    /**
     * @param array $id
     */
    public function getBaseURL($projectFile)
    {
        switch ($this->storage->getDefaultDriver()) {
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                .'/'.$projectFile->getFileName();
        }
    }

    /**
     * @param array $data
     */
    public function createFile(array $data)
    {

        $project = $this->projectRepository->skipPresenter()->find($data['project_id']);

        $projectFile = $project->files()->create($data);
        $this->storage->put($data['name'].'.'.$data['extension'], $this->filesystem->get($data['file']));

    }


}