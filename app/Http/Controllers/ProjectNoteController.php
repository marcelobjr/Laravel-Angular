<?php

namespace Code\Http\Controllers;

use Illuminate\Http\Request;
use Code\Repositories\ProjectNoteRepository;
use Code\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    /**
     * testClientController constructor.
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteService $service
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
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
        return $this->repository->findWhere(['project_id' => $id]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $noteId)
    {
        $result = $this->repository->findWhere(['project_id'=>$id, 'id'=>$noteId]);
        if(isset($result['data']) && count($result['data']) ==1){
            $result = ['data' => $result['data'][0]];
        }
        return $result;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $noteId)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($data,$noteId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $noteId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        return $this->service->destroy($noteId);
    }
}
