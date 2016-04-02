<?php

namespace Code\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Code\Repositories\ProjectRepository;
use Code\Services\ProjectService;


/**
 * Class ProjectController
 * @package Code\Http\Controllers
 */
class ProjectFileController extends Controller
{

    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * testClientController constructor.
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return $this->repository->all();
        return $this->repository->findWhere(['owner_id'=>\Authorizer::getResourceOwnerId()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        //return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->checkProject($id) == false)
        {
            return ['error' => 'Access forbiden', 'message'=> 'Usuário não autorizado'];
        }
        return $this->repository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        return $this->service->update($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
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
