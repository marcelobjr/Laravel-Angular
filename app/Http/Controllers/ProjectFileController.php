<?php

namespace Code\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Code\Repositories\ProjectFileRepository;
use Code\Services\ProjectFileService;


/**
 * Class ProjectFileController
 * @package Code\Http\Controllers
 */
class ProjectFileController extends Controller
{

    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var ProjectFileService
     */
    private $service;

    /**
     * ProjectFileController constructor.
     * @param ProjectFileRepository $repository
     * @param ProjectFileService $service
     */
    public function __construct(ProjectFileRepository $repository, ProjectFileService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
    return $this->repository->findWhere(['project_id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $data['extension'] = $file->getClientOriginalExtension();
        $data['file'] = $file;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        $this->service->createFile($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFile($id)
    {
        if($this->service->checkProjectPermissions($id) == false)
        {
            return ['error' => 'Access forbiden', 'message'=> 'Usuário não autorizado'];
        }
        return response()->download($this->service->getFilePath($id));
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->service->checkProjectPermissions($id) == false)
        {
            return ['error' => 'Access forbiden', 'message'=> 'Usuário não autorizado'];
        }
        return $this->repository->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->service->checkProjectOwner($id) == false){
            return ['error' => 'Access forbiden', 'message'=> 'Usuário não autorizado'];
        }
        return $this->service->update($request->all(),$id);

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->service->checkProjectOwner($id) == false){
            return ['error' => 'Access forbiden', 'message'=> 'Usuário não autorizado'];
        }
        return $this->service->destroy($id);
    }

    /**
     * @param $projectId
     * @return array
     */
    private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId,$userId);
    }

    /**
     * @param $projectId
     * @return mixed
     */
    private function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId,$userId);
    }

    /**
     * @param $projectId
     * @return bool
     */
    private function checkProject($projectId)
    {
        if(
        $this->checkProjectOwner($projectId) or
        $this->checkProjectMember($projectId)
        )
        {
         return true;
        }
        return false;
    }


}
